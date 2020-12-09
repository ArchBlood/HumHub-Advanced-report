# HumHub-Advanced-report
This module allow you to report users, comments and posts. Some code is based on this module :
https://github.com/humhub-contrib/reportcontent

## Report modal :
![alt text](https://github.com/Kodmit/HumHub-Advanced-report/blob/main/screenshots/screen1.png?raw=true)

## Reports dashboard
![alt text](https://github.com/Kodmit/HumHub-Advanced-report/blob/main/screenshots/screen2.png?raw=true)

I developed this module for my personal need, I'm not an Yii developer and I don't really know this framework. So don't hesitate to PR me.

## Enable reports in comments
In order to have reports in comment, you need to go to `humhub/modules/comment/widgets/views/comment.php`, and add the following code :

```php
use humhub\modules\report\widget\ReportCommentWidget;
// Line 69
<?php if (false === $canEdit): ?>
    <?= ReportCommentWidget::widget(['comment' => $comment]) ?>
<?php endif; ?>
// ...
```
