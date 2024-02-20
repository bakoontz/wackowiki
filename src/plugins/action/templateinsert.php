<?php
if (!defined('IN_WACKO'))
{
    exit;
}

/*
**
* 1. create a template
* 2. embrace the template, as if you would cite it (usage: <[define your template]>)
* 3. place this action beneath <[your template]> {{template.insert}}
*
* Displays a form to create a new page
* It first validates the form, then takes the above content between <[  ]>
* and puts it into db and then directs you to the newly created page using the header() function;
*
*/

$tpl->href        = $this->href();

if (isset($_POST['page']) && $_POST['page'] == 'result')
{
    $new_tag = (string) ($_POST['newpage'] ?? '');

    $this->sanitize_page_tag($new_tag);
    $tpl->tag        = $new_tag;

    if (!$new_tag)
    {
        // a valid name must be entered
        $tpl->message =  '<p class="error">' . $this->_t('InvalidNameError') . '</p>';
    }

    if (!preg_match('/^([' . self::PATTERN['TAG_P'] . ']+)$/u', $new_tag))
    {
        $this->set_message($this->_t('InvalidWikiName'));
    }

    // check reserved word
    if ($result = $this->validate_reserved_words($new_tag))
    {
        $this->set_message(Ut::perc_replace(
            $this->_t('PageReservedWord'),
            '<code>' . $result . '</code>'));
    }
    // check for existing page
    else if ($this->load_page($new_tag))
    {
        $tpl->message = Ut::perc_replace(
            $this->_t('AlreadyExists'),
            '<strong>' . $this->compose_link_to_page($new_tag, '', '') . '</strong>');
    }
    else
    {
        // Select content of page, where action is implemented,
        // but only content between "~<[" instead of "~]>" every other expression would do
        preg_match_all("/<\[(.*)\]>/us", $this->page['body'], $match);

        // in order to control output from $match, takes first match: var_dump($match); exit;
        $body        = $match[1][0];
        $edit_note    = '';

        // puts queried content "into new page"
        $this->save_page($new_tag, $body, '', $edit_note, false, 0, 0, 0, $this->page['page_lang'], false, false);

        $this->http->redirect($this->href('', $new_tag));
    }
}
