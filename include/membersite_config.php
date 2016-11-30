<?PHP
require_once("./include/membersite.php");

$membersite = new Membersite();

//Provide your site name here
$membersite->SetWebsiteName('localhost.com');

//Provide the email address where you want to get notifications
$membersite->SetAdminEmail('root@localhost.com');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$membersite->InitDB(/*hostname*/'localhost',
                      /*username*/'root',
                      /*password*/'',
                      /*database name*/'job_db',
                      /*table name*/'user');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$membersite->SetRandomKey('QdOOawipashiSNQ');
?>
