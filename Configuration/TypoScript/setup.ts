
plugin.tx_accessmanager_policy {
    view {
        templateRootPaths.0 = EXT:accessmanager/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_accessmanager_policy.view.templateRootPath}
        partialRootPaths.0 = EXT:accessmanager/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_accessmanager_policy.view.partialRootPath}
        layoutRootPaths.0 = EXT:accessmanager/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_accessmanager_policy.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_accessmanager_policy.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_accessmanager._CSS_DEFAULT_STYLE (
        textarea.f3-form-error {
                background-color:#FF9F9F;
                border: 1px #FF0000 solid;
        }

        input.f3-form-error {
                background-color:#FF9F9F;
                border: 1px #FF0000 solid;
        }

        .{extension.cssClassName} table {
                border-collapse:separate;
                border-spacing:10px;
        }

        .{extension.cssClassName} table th {
                font-weight:bold;
        }

        .{extension.cssClassName} table td {
                vertical-align:top;
        }

        .typo3-messages .message-error {
                color:red;
        }

        .typo3-messages .message-ok {
                color:green;
        }
)

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

plugin.tx_accessmanager._CSS_DEFAULT_STYLE >

plugin.tx_accessmanager_policy {
    settings {
        editIcon = {$plugin.tx_accessmanager_policy.settings.editIcon}
        editAction = {$plugin.tx_accessmanager_policy.settings.editAction}

        showIcon = {$plugin.tx_accessmanager_policy.settings.showIcon}
        showAction = {$plugin.tx_accessmanager_policy.settings.showAction}

        newIcon = {$plugin.tx_accessmanager_policy.settings.newIcon}
        newAction = {$plugin.tx_accessmanager_policy.settings.newAction}

        deleteIcon = {$plugin.tx_accessmanager_policy.settings.deleteIcon}
        deleteAction = {$plugin.tx_accessmanager_policy.settings.deleteAction}

        addIcon = {$plugin.tx_accessmanager_policy.settings.addIcon}
        addAction = {$plugin.tx_accessmanager_policy.settings.addAction}

        removeIcon = {$plugin.tx_accessmanager_policy.settings.removeIcon}
        removeAction = {$plugin.tx_accessmanager_policy.settings.removeAction}

        generalAdminUidList = {$plugin.tx_accessmanager_policy.settings.generalAdminUidList}
    }
}
