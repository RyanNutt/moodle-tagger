<?php
/**
 * Add to the quiz edit page
 * 
 * Ultimately this will add the form to add random questions to the
 * quiz edit page. For now, it's not doing anything. Just a placeholder. 
 */
global $PAGE;

if (!preg_match('/^mod-quiz-edit/', $PAGE->pagetype)) {
    // Not the right page type, just bail
    return;
}
//echo 'Add the quiz junk'; 