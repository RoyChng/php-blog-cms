<?php if(!empty($errors)){ ?>
        <ul>
        <?php foreach($errors as $error) { ?>
            <li><?= $error ?></li>
        <?php }?>
        </ul>
    <?php } ?>
    <form method="post">
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Article Title" value="<?= htmlspecialchars($title) ?>">
        </div>
        <div>
            <label for="content">Content</label>
            <textarea type="text" id="content" name="content" placeholder="Article Content"><?= htmlspecialchars($content) ?></textarea>
        </div>
        <div>
            <label for="published_at">Published At</label>
            <input type="datetime-local" id="published_at" name="published_at" value="<?= htmlspecialchars($published_at) ?>"> 
        </div>
        <button name="submit">Submit</button>
    </form>