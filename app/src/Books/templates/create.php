<?php
/**
 * @var array $authors
 */
?>
<form method="get" action="">
    <table>
        <tr>
            <td>Author</td>
            <td>
                <select name="author_id">
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author->id ?>"><?= $author->first_name ?> <?= $author->last_name ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Title</td>
            <td><input type="text" name="title" /> </td>
        </tr>

        <tr>
            <td>Price (ZAR)</td>
            <td><input type="text" name="price[ZAR]" /></td>
        </tr>
        <tr>
            <td>Price (USD)</td>
            <td><input type="text" name="price[USD]" /></td>
        </tr>

        <tr>
            <td>Price (GBP)</td>
            <td><input type="text" name="price[GBP]" /></td>
        </tr>
        
        
        <tr>
            <td colspan="2" align="right">
                <input type="submit" value="Create" />
            </td>
        </tr>
    </table>
</form>
