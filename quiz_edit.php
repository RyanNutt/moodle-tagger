<?php
/**
 * Add to the quiz edit page
 */
global $PAGE;

if (!preg_match('/^mod-quiz-edit/', $PAGE->pagetype)) {
    // Not the right page type, just bail
    return;
}
echo 'Add the quiz junk'; 