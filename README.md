# Valerii_Comment module

## Overview

The ProductComment Magento Extension enhances the product view page (PDP) by adding a new tab, "Comments," to the tab container. This tab provides a comprehensive view of all product comments and a user-friendly form to add new comments for the specific product.
### Viewing All Comments

All comments are displayed in descending order based on their posted date. The format for each comment is as follows:



`dd-MM-YYYY HH:mm:ss - Name (email)
Body message`

### Posting a Comment

The "Add Comment" form includes the following fields:

```
Name
Email
Message
```

If a customer is logged in, their First Name is automatically set in the "Name" input, and the "Name" input becomes read-only. Similarly, if a customer is logged in, their email is automatically set in the "Email" input, and the "Email" input becomes read-only.

### Grid Columns

The grid includes the following columns:
```
comment_id
product_id
customer_id
store_id
email
name
message
created_at
```
