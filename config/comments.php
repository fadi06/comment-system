<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default User Model
    |--------------------------------------------------------------------------
    |
    | Define the user model that will be associated with comments.
    | By default, it uses App\Models\User but you can change this
    | if your application uses a different User class.
    |
    */
    'user_model' => App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Comments Table
    |--------------------------------------------------------------------------
    |
    | Name of the table that will store comments.
    |
    */
    'table_name' => 'comments',

    /*
    |--------------------------------------------------------------------------
    | Enable Image Attachments
    |--------------------------------------------------------------------------
    |
    | Allow users to upload and attach images with their comments.
    | Requires storage and public disk configuration.
    |
    */
    'allow_images' => true,

    /*
    |--------------------------------------------------------------------------
    | Max Upload Size (KB)
    |--------------------------------------------------------------------------
    |
    | Maximum image upload size in kilobytes.
    |
    */
    'max_upload_size' => 2048, // 2MB

    /*
    |--------------------------------------------------------------------------
    | Voting System
    |--------------------------------------------------------------------------
    |
    | Enable or disable upvotes/downvotes on comments.
    |
    */
    'enable_votes' => true,

    /*
    |--------------------------------------------------------------------------
    | Guest allow for comments and votes
    |--------------------------------------------------------------------------
    |
    | Enable or disable allow guest for vote and commit
    |
    */
    'allow_guest_for_commit' => true,
];
