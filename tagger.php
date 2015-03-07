<?php
class Tagger {
    
    /**
     * Returns an array of all tags that have been used for questions
     */
    public static function get_tags() {
        //select ins.tagid, ins.itemtype, tag.id, tag.name, tag.rawname FROM mdl_tag_instance ins JOIN mdl_tag tag ON tag.id=ins.tagid WHERE ins.itemtype='question' GROUP BY ins.tagid ORDER BY tag.name ASC
        
        global $DB;
        $results = $DB->get_records_sql("select ins.tagid, ins.itemtype, tag.id, tag.name, tag.rawname FROM {tag_instance} ins JOIN {tag} tag ON tag.id=ins.tagid WHERE ins.itemtype='question' GROUP BY ins.tagid ORDER BY tag.name ASC");
        
        return $results; 
    }
    
}