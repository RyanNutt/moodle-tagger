
local_tagger = {
    init: function () {
        jQuery("input.tagger").select2({
            tags:tagger.tags, 
            tokenSeparators: [',']
        });
        
    }
}

jQuery(document).ready(function () {
    local_tagger.init();
});