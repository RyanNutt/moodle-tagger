
local_tagger = {
    init: function () {

        if (jQuery('input.tagger').length > 0) {
            jQuery("input.tagger").select2({
                tags: tagger.tags,
                tokenSeparators: [',']
            });
        }

        if (jQuery('div#fitem_id_tags').length > 0) {
            var el = jQuery('div#fitem_id_tags');

            // Hide the existing one
            el.hide();

            // Add in our own stuff
            var html = '<div class="fitem fitem_tagger">';
            html += '<div class="fitemtitle">';
            html += '<div class="fgrouplabel"><label>Tags</label></div>';
            html += '</div>'; // .fitemtitle
            html += '<fieldset class="felement ftagger">';
            html += '<input type="text" class="tagger_tags" id="tagger_tags" style="width:100%;">';
            html += '</fieldset>'; // .felement
            html += '</div>'; // .fitem

            el.after(html);

            var official_tags = jQuery('select#id_tags_officialtags').val();
            if (!official_tags) {
                // Make it an empty array if there aren't any official tags
                official_tags = [];
            }

            var extra_tags = jQuery('textarea#id_tags_othertags').val().trim();
            if (extra_tags) {
                extra_tags = extra_tags.split(',');
            }
            else {
                extra_tags = []
            }

            var all_tags = official_tags.concat(extra_tags).unique();

            //jQuery('input#tagger_tags').val(jQuery('textarea#id_tags_othertags').val()); 

            if (all_tags.length > 0) {
                jQuery('input#tagger_tags').val(all_tags.join(', '));
            }

            jQuery('input#tagger_tags').select2({
                tags: tagger.tags,
                tokenSeparators: [','],
                sortResults: function (results, container, query) {
                    if (query.term) {
                        // use the built in javascript sort function
                        return results.sort();
                    }
                    return results;
                }
            });

            jQuery('input#tagger_tags').change(function () {
                jQuery('textarea#id_tags_othertags').val(jQuery(this).val());
            });
            //console.info(jQuery('.select2-drop')); 
            //jQuery('.select2-drop').css('width', 'auto'); 
        }

    }
}

jQuery(document).ready(function () {
    local_tagger.init();
});

Array.prototype.unique = function () {
    var a = this.concat();
    for (var i = 0; i < a.length; ++i) {
        for (var j = i + 1; j < a.length; ++j) {
            if (a[i] === a[j])
                a.splice(j--, 1);
        }
    }

    return a;
};