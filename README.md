# WP-iMember360-Post

This repo introduces the hooks to insert/update posts in iMember360 Wordpress plugin.

## i4w_insert_post


### Usage:
This hook enables you to safely run your code after a page/post has been inserted.


### Parameters:
iMember360 will pass the following parameters to your action function:

#### $post_id
is the post ID of the page/post being updated
#### $post
is the content of the entire $post object
#### $update
determines if the action is an “insert” (false) or an “update” (true)

### Example:
* This URL: [i4w_insert_post.php](https://github.com/eujinong/WP-iMember360-Post/blob/master/i4w_insert_post.php)


## i4w_saved_post


### Usage:
This hook enables you to safely run your code after a page/post has been inserted or updated.


### Parameters:
iMember360 will pass the following parameters to your action function:

#### $post_id
is the post ID of the page/post being updated
#### $post
is the content of the entire $post object
#### $update
determines if the action is an “insert” (false) or an “update” (true)

### Example:
* This URL: [i4w_saved_post.php](https://github.com/eujinong/WP-iMember360-Post/blob/master/i4w_saved_post.php)


## i4w_update_post


### Usage:
This hook enables you to safely run your code after a page/post has been updated.


### Parameters:
iMember360 will pass the following parameters to your action function:

#### $post_id
is the post ID of the page/post being updated
#### $post
is the content of the entire $post object
#### $update
determines if the action is an “insert” (false) or an “update” (true)

### Example:
* This URL: [i4w_update_post.php](https://github.com/eujinong/WP-iMember360-Post/blob/master/i4w_update_post.php)
