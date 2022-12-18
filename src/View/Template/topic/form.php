
<form method="post" enctype="multipart/form-data">

    <input type="text" class="title" name="topic-title" placeholder="<?= translate("title") ?>" <?= isset($_GET["title"]) ? "value=\"".$_GET["title"]."\"" : "" ?>/>
    <textarea class="content" name="topic-content" placeholder="<?= translate("content") ?>"><?= isset($_GET["content"]) ? $_GET["content"] : "" ?></textarea>
    <input type="file" class="content" name="topic-header"/>
    <select name="topic-mood" >
        <option value="0" <?= isset($_GET["mood"]) && $_GET["mood"] == 0 ? "selected" : "" ?>>&#128512;</option>
        <option value="1" <?= isset($_GET["mood"]) && $_GET["mood"] == 1 ? "selected" : "" ?>>&#128542;</option>
        <option value="2" <?= isset($_GET["mood"]) && $_GET["mood"] == 2 ? "selected" : "" ?>>&#129300;</option>
        <option value="3" <?= isset($_GET["mood"]) && $_GET["mood"] == 3 ? "selected" : "" ?>>&#128577;</option>
    </select>
    <button class="submit"><?= translate("confirm") ?></button>

</form>
