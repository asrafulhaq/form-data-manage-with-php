<?php

if (file_exists(__DIR__ . "/autoload.php")) {
    require_once __DIR__ .  "/autoload.php";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // get form values
        $name = $_POST['name'];
        $phone = $_POST['phone'];

        // file manage 
        $tmp_name = $_FILES['profile']['tmp_name'];
        $file_name = $_FILES['profile']['name'];



        if (empty($name) || empty($phone)) {
            $msg = createAlert('All fields are required !');
        } else {

            //  uplaod file 
            move_uploaded_file($tmp_name, 'photos/' . $file_name);

            $msg = createAlert('Data Stable !', 'success');
            reset_form();
        }
    }



    ?>

    <div class="container my-5">
        <div class="row my-5 justify-content-center">
            <div class="col-md-4 my-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="card-title">Update your Profile</h2>
                    </div>
                    <div class="card-body">
                        <?php echo $msg  ?? '';  ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="my-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?php echo old('name'); ?>" class="form-control">
                            </div>
                            <div class="my-3">
                                <label for="">Phone</label>
                                <input type="text" name="phone" value="<?php echo old('phone'); ?>" class="form-control">
                            </div>
                            <div class="my-3">
                                <label for="">Profile Photo</label>
                                <label class="uploader">
                                    <input type="file" id="profile-photo" name="profile" class="form-control">
                                    <img id="profile-photo-icon" src="https://static.thenounproject.com/png/11204-200.png" alt="">
                                </label>
                                <div class="preview-image">
                                    <img id="profile-photo-preview" src="" alt="">
                                    <button type="button" id="profile-photo-close"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="my-3">
                                <input type="submit" value="save" class="btn btn-success w-100">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const profilePhoto = document.getElementById('profile-photo');
        const profilePhotoPreview = document.getElementById('profile-photo-preview');
        const profilePhotoIcon = document.getElementById('profile-photo-icon');
        const profilePhotoClose = document.getElementById('profile-photo-close');

        profilePhoto.onchange = (event) => {
            const imageURL = URL.createObjectURL(event.target.files[0]);

            profilePhotoPreview.setAttribute('src', imageURL);
            profilePhotoIcon.style.display = 'none';
            profilePhotoClose.style.display = 'block';
        }

        profilePhotoClose.onclick = () => {
            profilePhotoPreview.setAttribute('src', "");
            profilePhotoIcon.style.display = 'block';
            profilePhotoClose.style.display = 'none';

        }
    </script>
</body>

</html>