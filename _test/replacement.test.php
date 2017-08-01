<?php
/**
 * Tests for the replacement in the preventzerowidthchars plugin
 *
 * @group plugin_preventzerowidthchars
 * @group plugins
 */
class replacement_plugin_preventzerowidthchars_test extends DokuWikiTest {
    protected $pluginsEnabled = array('preventzerowidthchars');

    public function replacement_data() {
        return [
            [
                'http://​php.net/​images/​php.gif',
                'http://php.net/images/php.gif',
                '<200b>',
            ]
        ];
    }

    /**
     * @param $input
     * @param $expected_output
     * @param $msg
     *
     * @dataProvider replacement_data
     */
    public function test_replacement($input, $expected_output, $msg) {
        /** @var action_plugin_preventzerowidthchars $action */
        $action = plugin_load('action', 'preventzerowidthchars');

        $actual_output = $action->replaceZeroWidthChars($input);

        $this->assertEquals($expected_output, $actual_output, 'Failed to remove ' . $msg);
    }
}
