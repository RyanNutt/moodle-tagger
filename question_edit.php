<?php
/**
 * Updates the tag edit section of the question edit page with the
 * select2 style dropdowns instead of the default options.
 */
global $PAGE;

if (!preg_match('/^question-type-/', $PAGE->pagetype)) {
    // Not the right page type, just bail
    return;
}
$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url('https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.js'));
$PAGE->requires->js('/local/tagger/js/tagger.js');

// Get the list of available tags and embed them in JS
$tags = array_merge(Tagger::get_official_tags(), Tagger::get_tags());
$tag_names = array();
if (!empty($tags)) {
    foreach ($tags as $tag) {
        $tag_names[] = $tag->name;
    }
}
$tag_names = array_unique($tag_names); 
natsort($tag_names); 
?>
<script type="text/javascript">
    var tagger = {};
    tagger.tags = ['<?php echo implode("','", $tag_names); ?>'];
</script>


