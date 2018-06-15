
plugin.tx_accessmanager_policy {
    view {
        # cat=plugin.tx_accessmanager_policy/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:accessmanager/Resources/Private/Templates/
        # cat=plugin.tx_accessmanager_policy/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:accessmanager/Resources/Private/Partials/
        # cat=plugin.tx_accessmanager_policy/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:accessmanager/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_accessmanager_policy//a; type=string; label=Default storage PID
        storagePid =
    }
}

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

plugin.tx_accessmanager_policy {
  settings {
    # cat=plugin.tx_accessmanager_policy//a; type=string; label=Image Resource for edit icon
    editIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-open.svg

    # cat=plugin.tx_accessmanager_policy//b; type=string; label=Name of edit action
    editAction = edit

    # cat=plugin.tx_accessmanager_policy//c; type=string; label=Image Resource for show icon
    showIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-view.svg

    # cat=plugin.tx_accessmanager_policy//d; type=string; label=Name of show action
    showAction = show

    # cat=plugin.tx_accessmanager_policy//e; type=string; label=Image Resource for new icon
    newIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-add.svg
    
    # cat=plugin.tx_accessmanager_policy//f; type=string; label=Name of new action
    newAction = new

    # cat=plugin.tx_accessmanager_policy//g; type=string; label=Image Resource for delete icon
    deleteIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-delete.svg

    # cat=plugin.tx_accessmanager_policy//h; type=string; label=Name of delete action
    deleteAction = delete

    # cat=plugin.tx_accessmanager_policy//i; type=string; label=Image Resource for add icon
    addIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-add.svg

    # cat=plugin.tx_accessmanager_policy//j; type=string; label=Name of add action
    addAction = add

    # cat=plugin.tx_accessmanager_policy//k; type=string; label=Image Resource for remove icon
    removeIcon = EXT:core/Resources/Public/Icons/T3Icons/actions/actions-remove.svg

    # cat=plugin.tx_accessmanager_policy//l; type=string; label=Name of remove action
    removeAction = remove

    # cat=plugin.tx_accessmanager_policy//m; type=string; label=Give unrestricted access to following user UIDs
    generalAdminUidList = 

  }
}

