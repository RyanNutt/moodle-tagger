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

echo 'keep going'; 
