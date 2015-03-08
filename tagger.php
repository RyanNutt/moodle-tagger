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
    
    /**
     * Returns a list of all official tags
     */
    public static function get_official_tags() {
        global $DB;
        $results = $DB->get_records_sql("SELECT id, name, rawname, tagtype FROM {tag} WHERE tagtype='official' ORDER BY name ASC"); 
        return $results; 
    }
    
}