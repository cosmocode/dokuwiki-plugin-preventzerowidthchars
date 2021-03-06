<?php
/**
 * DokuWiki Plugin preventzerowidthchars (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Michael Große <grosse@cosmocode.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_preventzerowidthchars extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('COMMON_WIKIPAGE_SAVE', 'BEFORE', $this, 'handle_common_wikipage_save');
    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */

    public function handle_common_wikipage_save(Doku_Event $event, $param) {
        $event->data['newContent'] = $this->replaceZeroWidthChars($event->data['newContent']);
    }


    public function replaceZeroWidthChars($uncleanText) {
        $cleanedText = strtr($uncleanText, [
            "\xE2\x80\x8B" => '', // zero width space
        ]);
        return $cleanedText;
    }

}

// vim:ts=4:sw=4:et:
