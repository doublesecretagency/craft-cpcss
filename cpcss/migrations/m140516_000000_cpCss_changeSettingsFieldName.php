<?php
namespace Craft;

/**
 * The class name is the UTC timestamp in the format of mYYMMDD_HHMMSS_migrationName
 */
class m140516_000000_cpCss_changeSettingsFieldName extends BaseMigration
{
    /**
     * Any migration code in here is wrapped inside of a transaction.
     *
     * @return bool
     */
    public function safeUp()
    {
        // Get original settings value
        $query = craft()->db->createCommand()
            ->select('settings')
            ->from('plugins')
            ->where('class="CpCss"')
        ;
        $oldSettings = $query->queryRow();
        $settings = json_decode($oldSettings['settings'], true);
        // Change setting name
        $settings['additionalCss'] = $settings['cpCss'];
        unset($settings['cpCss']);
        // Update settings field
        $newSettings = json_encode($settings);
        $this->update('plugins', array('settings'=>$newSettings), 'class="CpCss"');
        return true;
    }
}
