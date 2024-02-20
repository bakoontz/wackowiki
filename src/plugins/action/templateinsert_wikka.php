<?php

if (!defined('IN_WACKO'))
{
    exit;
}

if ($user = $this->get_user_name()) {
/*
**
* 1. create a template(Mustervorlage)
* 2. embrace the template, as if you would cite it (usage: <[define your template]>)
* 3. place this action beneath <[your template]> {{template.insert}}
*
* Displays a form to create a new page
* It first validates the form, then takes the above content between <[  ]>
* and puts it into db and then directs you to the newly created page using the header() function;
*
* for function GetTranslation to work properly you need to put
* "CreateButton"=>"Create", ("CreateButton"=>"Translationtoyourlanguage",)
* "NewPage"=>"<b>Your PageName: </b>", ("CreateNewPage"=>"<b>Translation: </b>",)
* in /lang/wakka."yourlanguage".php file
*/
$path = $this->GetPagePath();
$path = strip_tags($path);
$seitentitel = $_POST["newpage"];
$path = str_replace( "?", "", $path);
$form = $this->FormOpen().
            
            "\n<input type=\"hidden\" name=\"page\" value=\"result\">".
            "\n<hr />".$this->GetTranslation("CreateNewPage")."Die Unterseite <b>".$this->GetUserName()."</b>"."/<input name=\"newpage\" value=\"".$_POST["newpage"]."\" type=\"text\" size=\"20\"/>".
        "<input type=\"submit\" value=\"".$this->GetTranslation("CreateButton")."\" <hr />".

        
$this->FormClose();

if (!$seitentitel) {
    
        // a valid name must be entered
echo $this->GetTranslation("CreateNewPage")."F¸ge eine Unterseite hinzu.<br />W‰hle ein selbsterkl‰rendes Wort ohne Umlaute (‰, ˆ, ¸) und Sonderzeichen, z.B. <b>Musik</b>, <b>Hobby</b>, <b>Tiere</b> oder <b>Autos</b>";  
        echo $form;          
    }
    else
        

if ($_POST["page"]=="result") {
    
    $newpage = $this->GetUserName()."/".$_POST["newpage"];
    
     if (!$newpage) {
    
        // a valid name must be entered
        echo "<p class=\"error\">Bitte den Seitennamen eingeben</p>";    
        echo $form;    
    } else 
    
    if ($existingPage = $this->LoadPage($this->GetUserName()."/".$_POST["newpage"]))
    {
      echo "Eine Seite mit diesem Namen existiert bereits!<br />Bitte einen neuen Seitentitel eingeben:";
      echo $form;
      }
      
      else
    {
        
        // Select content of page, where action is implemented,
        
           $tag = $this->getPageTag();
         $sql = $this->LoadSingle("select body from ".$this->config["table_prefix"]."pages"." where tag='".quote($tag)."'");
         $sql = str_replace( ":::", "::::", $sql);
        //but only content between "~<[" instead of "~]>" every other expression would do
        $in=$sql["body"];
    preg_match_all("/<\[(.*)\]>/s",$in,$treffer);
        
    // in order to control output from $treffer: var_dump($treffer); exit;
         $body = $treffer[1][0];
        
// current user is owner; if user is logged in! otherwise, no owner.

       $write_acl = $this->GetUserName();
       $owner = $this->GetUserName();
       
//puts querried content "into new page"

       $this->Query("insert into ".$this->config["table_prefix"]."pages set ".
         ($comment_on ? "comment_on = '".quote($comment_on)."', " : "").
         ($comment_on ? "super_comment_on = '".quote($this->NpjTranslit($comment_on))."', " : "").
         "time = now(), ".
         "owner = '".quote($owner)."', ".
         "user = '".quote($owner)."', ".
         "latest = 'Y', ".
         "supertag = '".quote($this->NpjTranslit($newpage))."', ".
         "body = '".quote($body)."', ".
         "body_r = '".quote($body_r)."', ".
         "body_toc = '".quote($body_toc)."', ".
         "lang = '".quote($lang)."', ".
         "tag = '".quote($newpage)."'");
         
$this->SaveAcl($newpage, "write", ($comment_on ? "" : $write_acl));

// here the script is not quite ready, validation not complete, when accidently overwriting an existing page
/* Redirect browser */

header('Location:'.$this->config["base_url"].$newpage);

/* Make sure that code below does not get executed when we redirect. */
exit;

    }    
} else {
    echo $form;
}
}
else
echo "<p class=\"error\">Bitte einloggen! Nur angemeldete Benutzer / Benutzerinnen kˆnnen Seiten hinzuf¸gen."

?>
