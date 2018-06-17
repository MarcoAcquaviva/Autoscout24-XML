# Autoscout24-XML
An XML file generator to send to autoscount24. 

This php file has been made based on flexicontent joomla's plugin and database.

How to:

- Create a new DB "yourRoot_autoscout" with all the field you want import.

- Override Flexicontent save button and add a redirect to Update.php, the Update.php will override data into the DB created on the previous step.

- Now all you need to do is to create a button into backend that launch Autoscout-generator.php.

N.B. You need to change path and table with your current DB addresses