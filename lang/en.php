<?php
return [
        'app_name'        => 'Warehouse Inventory',
        'app_tagline'     => 'Stock Management Information System',

        // Navigation
        'nav_items'       => 'Items',
        'nav_add'         => 'Add Item',
        'nav_logout'      => 'Logout',
        'welcome'         => 'Hello',
        'language'        => 'Language',

        // Login
        'login_title'     => 'Sign In',
        'username'        => 'Username',
        'password'        => 'Password',
        'btn_login'       => 'Sign In',
        'err_username_required' => 'Username is required.',
        'err_password_required' => 'Password is required.',
        'err_login_failed'      => 'Incorrect username or password.',
        'msg_logout'      => 'You have been logged out.',
        'msg_login_required' => 'Please log in first.',

        // Dashboard
        'stat_types'      => 'Item Types',
        'stat_stock'      => 'Total Stock',
        'stat_low'        => 'Low Stock',
        'stat_value'      => 'Inventory Value',

        // Table
        'title_list'      => 'Warehouse Item List',
        'search_ph'       => 'Search code / item name...',
        'btn_search'      => 'Search',
        'btn_reset'       => 'Reset',
        'col_no'          => 'No',
        'col_code'        => 'Code',
        'col_name'        => 'Item Name',
        'col_category'    => 'Category',
        'col_qty'         => 'Quantity',
        'col_unit'        => 'Unit',
        'col_price'       => 'Unit Price',
        'col_location'    => 'Rack Location',
        'col_action'      => 'Actions',
        'empty_data'      => 'No item data yet.',
        'low_badge'       => 'Low',

        // Categories
        'cat_elektronik'  => 'Electronics',
        'cat_makanan'     => 'Food',
        'cat_kemasan'     => 'Packaging',
        'cat_kebersihan'  => 'Cleaning',
        'cat_lainnya'     => 'Others',
        'choose_category' => '-- Select Category --',
        'choose_unit'     => '-- Select Unit --',

        // Form
        'title_add'       => 'Add New Item',
        'title_edit'      => 'Edit Item',
        'btn_save'        => 'Save',
        'btn_update'      => 'Update',
        'btn_cancel'      => 'Cancel',
        'btn_edit'        => 'Edit',
        'btn_delete'      => 'Delete',
        'confirm_delete'  => 'Are you sure you want to delete this item?',

        // Validation
        'err_csrf'        => 'Invalid form session. Please reload the page.',
        'err_code_required'   => 'Item code is required.',
        'err_code_format'     => 'Item code may only contain letters, numbers, and hyphens (max. 20 characters).',
        'err_code_exists'     => 'Item code is already in use.',
        'err_name_required'   => 'Item name is required.',
        'err_name_length'     => 'Item name must be at most 100 characters.',
        'err_category_invalid'=> 'Invalid / unselected category.',
        'err_qty_invalid'     => 'Quantity must be a whole number, 0 or greater.',
        'err_unit_invalid'    => 'Invalid / unselected unit.',
        'err_price_invalid'   => 'Price must be a number, 0 or greater.',
        'err_location_length' => 'Rack location must be at most 30 characters.',
        'err_not_found'       => 'Item data not found.',

        // Success messages
        'msg_created'     => 'Item added successfully.',
        'msg_updated'     => 'Item updated successfully.',
        'msg_deleted'     => 'Item deleted successfully.',

        'footer'          => 'Web Programming Assignment - PHP & MySQL',
];