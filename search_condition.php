<?php
defined('MOODLE_INTERNAL') || die();

function local_tagger_get_question_bank_search_conditions($caller) {
    return array(new local_tagger_question_bank_search_condition($caller));
}

class local_tagger_question_bank_search_condition extends core_question\bank\search\condition {

    protected $where;
    protected $tags;
    protected $params;

    /** List of tags to exclude */
    private $exclude;

    /** List of tags to include */
    private $include;

    /** Array of ids to exclude, used in an IN clause */
    private $exclude_ids = array();

    /** Array of ids to include, used in an IN clause */
    private $include_ids = array();

    public function __construct() {
        global $PAGE;
        $PAGE->requires->jquery();
        //$PAGE->requires->jquery_plugin('ui');
        //$PAGE->requires->jquery_plugin('ui-css');

        $this->exclude = optional_param('tagger_exclude', '', PARAM_TEXT);
        $this->include = optional_param('tagger_include', '', PARAM_TEXT);
        if (!empty($this->exclude) || !empty($this->include)) {
            $this->init();
        }
    }

    public function where() {
        return $this->where;
    }

    public function params() {
        return $this->params;
    }

    public function init() {
        global $DB;
        if (!empty($this->include) && !is_array($this->include)) {
            $this->include = explode(',', $this->include);

            // Get the IDs
            $results = $DB->get_records_sql("SELECT id FROM {tag} WHERE name IN ('" . implode("','", $this->include) . "')");
            if (!empty($results)) {
                foreach ($results as $res) {
                    $this->include_ids[] = $res->id;
                }
            }
        }
        if (!empty($this->exclude) && !is_array($this->exclude)) {
            $this->exclude = explode(',', $this->exclude);

            // Get the IDs
            $results = $DB->get_records_sql("SELECT ID FROM {tag} WHERE name IN ('" . implode("','", $this->exclude) . "')");
            if (!empty($results)) {
                foreach ($results as $res) {
                    $this->exclude_ids[] = $res->id;
                }
            }
        }

        $where_parts = array();
        if (!empty($this->include_ids)) {
            $where_parts[] = " q.id IN (SELECT itemid FROM {tag_instance} WHERE tagid IN ('" . implode("','", $this->include_ids) . "')) ";
        }
        if (!empty($this->exclude_ids)) {
            $where_parts[] = " q.id NOT IN (SELECT itemid FROM {tag_instance} WHERE tagid IN ('" . implode("','", $this->exclude_ids) . "')) ";
        }

        if (!empty($where_parts)) {
            $this->where = ' ( ' . implode(' AND ', $where_parts) . ' ) ';
        }
    }

    public function display_options() {
        
        global $PAGE;
        if ('mod-quiz-edit' != $PAGE->pagetype) {
            return; 
        } 
        //echo '<pre>'.print_r($PAGE, true).'</pre>'; 
        //$PAGE->requires->jquery();
        $PAGE->requires->js('/local/tagger/js/tag-it.js');
        //$PAGE->requires->js('https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.css
        $PAGE->requires->js(new moodle_url('https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.js'));
        $PAGE->requires->js('/local/tagger/js/tagger.js');
        ?>
        <div class="tagger_search">
            <strong>Search by Tag</strong>
            <div>
                Tagged with
            </div>
            <input type="text" class="tagger" style="width:100%;" name="tagger_include" id="tagger_include" value="<?php echo (!empty($_GET['tagger_include']) ? $_GET['tagger_include'] : ''); ?>">


            <div>
                Exclude tags
            </div>
            <input type="text" class="tagger" style="width:100%;" name="tagger_exclude" id="tagger_exclude" value="<?php echo (!empty($_GET['tagger_exclude']) ? $_GET['tagger_exclude'] : ''); ?>">



            <div>
                <input type="submit" value="Search Questions">
            </div>
        </div>
        <?php
        $tags = Tagger::get_tags();

        $tag_names = array();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $tag_names[] = $tag->name;
            }
        }
        ?>
        <script type="text/javascript">
            var tagger = {};
            tagger.tags = ['<?php echo implode("','", $tag_names); ?>'];
        </script>
        <?php
    }

}
