<?php
$pageTitle = 'Welcome, Admin';
$cssLink = 'CSS/adminPanel.css';
require_once './CategoryClass.php';
$categories = Category::getAllCategoriesName();
include 'header.php';
if (!$loggedIn) {
    header("Location: index.php");
}
?>
<script type="text/javascript">
    function editCategory(field, oldName) {
        val = $(field).val();
        $('#submit').css('display', 'inline-block');
        $('#submit').css('float', 'left');
        $('#newName').attr('value', val);
        $('#oldName').attr('value', oldName);

    }

</script>
<h1>Welcome, <?php echo $currentUser->firstName ?></h1>
<hr>
<table class="table" style="float: left">
    <thead>
        <tr>
            <th><h4>Category</h4></th>
            <th><h4>Actions</h4></th>
        </tr>
    </thead>
<tbody>
    <?php for ($i = 0; $i < count($categories); $i++) { ?>
        <tr>
            <td><input id="field<?php echo $i ?>" type="text" value="<?php echo $categories[$i]['name'] ?>" disabled></td>
            <td>
                <a class="button" onclick="editCategory('#field<?php echo $i ?>', '<?php echo $categories[$i]['name'] ?>')">
                    Edit
                </a> 
                <a href="deleteCategory.php?id=<?php echo Category::getCategoryID($categories[$i]['name']) ?>" 
                   class="button" onclick="return confirm('Are you sure you want to delete it?')">
                    Delete
                </a>
            </td>

        </tr>
    <?php } ?>   
</tbody>
</table>    
<div id="submit" style="display:none;">                                
    <form class="formBox" action="editCategory.php" method="POST">
        <label><h4>New name</h4></label>
        <input class="input" id="newName" name="newName" type="text" value="">
        <input id="oldName" name="oldName" hidden value="">
        <input type="submit" class="button" value="Submit Changes">
    </form>    
</div>
<?php include 'footer.php'; ?>