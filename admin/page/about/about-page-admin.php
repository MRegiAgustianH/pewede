<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deskripsi'])) {
    require_once('../model/about.php');

    $deskripsi = $_POST['deskripsi'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if (empty($deskripsi)) {
        $_SESSION['error'] = "Description cannot be empty!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $about = new About();

    try {

        $result = $about->updateAbout($id, $deskripsi);

        if ($result) {
            $_SESSION['success'] = "Description updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update description!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>

<h2 class="mt-4 mb-4"><i class="fas fa-layer-group"></i> About Mitaa</h2>
<div class="row">
    <div class="col">
        <div class="card">
            <?php
            require_once('../model/about.php');
            $about = new About();
            $aboutData = $about->getAll();
            ?>

            <div id="editMode">
                <form action="" method="post">
                    <?php
                    if (!empty($aboutData)) {
                        foreach ($aboutData as $row) {
                            echo '<div class="form-group">';
                            echo '<textarea name="deskripsi" class="form-control" rows="5">'
                                . htmlspecialchars($row['deskripsi']) . '</textarea>';
                            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                            echo '</div>';
                        }
                    }
                    ?>
                    <div class="form-group m-3">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>