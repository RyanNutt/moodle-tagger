# Tagger Moodle Plugin #

This plugin is my attempt at making the question tagging abilities built into Moodle more useful. Currently you can tag questions, but not do anything with those tags. And the interface for tagging is a little lacking. 

## What's it do? ##
The default interface in Moodle for tagging questions just didn't work for me. My guess is tagging was added to Moodle and there just hasn't been the time to get it working exactly like it was planned. That's pretty much the only downside to FOSS software. 

What I wanted, and what's there right now, is the ability to tag questions with an interface more like how other sites are implementing tagging. The jQuery [Select2](https://select2.github.io/) plugin was perfect for what I wanted, and what I wound up using. 

And I've also added the ability to search questions based on tags, although it still needs some work. 

I'd also like to add the ability to create quizzes from random questions based on tags. Haven't had a chance to start working on that yet though. 

## Download and Install ##
Well, probably shouldn't just yet. 

I'm uploading it into Github for all the source control goodness, but it's not quite ready for prime time yet. It's sort of working on my development box. But I've done pretty much zero testing to see if it works on any other servers or with any other themes. Eventually I'm planning on uploading it to the Moodle server that I'm using for the classes I teach, but we'll have to wait a bit to see how that goes. 

## Screenshots ##

This is what the default tagging screen looks like in Moodle. Might be a bit different between themes, but it just doesn't work for me.

![](https://raw.githubusercontent.com/RyanNutt/moodle-tagger/master/pix/screenshots/default-tagging.PNG)

Here is the same section of the question editing page with the Tagger plugin installed. 

![](https://github.com/RyanNutt/moodle-tagger/blob/master/pix/screenshots/new-tagging.PNG?raw=true)

And one more for now. This is an addition to the question search pages. You'll see this either in the question bank or when you add new questions to a quiz. This one will probably change a bit though.

![](https://github.com/RyanNutt/moodle-tagger/blob/master/pix/screenshots/search-by-tag.PNG?raw=true)

