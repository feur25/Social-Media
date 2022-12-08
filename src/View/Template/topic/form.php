<form class="topic-form" enctype="multipart/form-data" method="post" action="">
                
    <input type="text" class="title" name="topic-title" placeholder="<?= translate("title") ?>" <?= isset($_GET["title"]) ? "value=\"".$_GET["title"]."\"" : "" ?>/>
    <input type="text" class="content" name="topic-content" placeholder="<?= translate("content") ?>" <?= isset($_GET["content"]) ? "value=\"".$_GET["content"]."\"" : "" ?>/>
    <input type="file" class="content" name="topic-url-profile" id="topic-url-profile" <?= isset($_GET["header"]) ? "value=\"".$_GET["header"]."\"" : "" ?>/>
    <select name="topic-mood" >
        <option value="0" <?= isset($_GET["mood"]) && $_GET["mood"] == 0 ? "selected" : "" ?>>&#128512;</option>
        <option value="1" <?= isset($_GET["mood"]) && $_GET["mood"] == 1 ? "selected" : "" ?>>&#128542;</option>
        <option value="2" <?= isset($_GET["mood"]) && $_GET["mood"] == 2 ? "selected" : "" ?>>&#129300;</option>
        <option value="3" <?= isset($_GET["mood"]) && $_GET["mood"] == 3 ? "selected" : "" ?>>&#128577;</option>
    </select>
    <button class="submit"><?= translate("confirm") ?></button>

</form>
