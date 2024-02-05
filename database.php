<?php
include dirname(__DIR__) . '/config/database.php';
include dirname(__DIR__) . './config/baseurl.php';
//checklogin
if (!$_SESSION['loged_in']) {
    header('Location: ' . $base_url . 'login.php');
}
//checkadmin
include('checkadmin.php');
include dirname(__DIR__) . './template/header.php';
include dirname(__DIR__) . './template/navbar.php';
// แสดงค่า $_POST
print_r($_POST);
//เรียกข้อมูลประเภทโครงการ
$sql = "SELECT* FROM tbl_project_type WHERE delete_at IS NULL ORDER BY project_type_name ASC";
$stmt = $db->prepare($sql);
$stmt->execute();
$project_type = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<header class="site-header d-flex flex-column justify-content-center align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>/index.php">หน้าแรก</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลโครงการ</li>
                    </ol>
                </nav>
                <h2 class="text-white">เพิ่มข้อมูลโครงการ</h2>
            </div>
        </div>
    </div>
</header>

<section class="section-padding pt-4">
    <div class="container">
        <div class="col-lg-8 col-12 mx-auto">
            <div class="custom-block custom-block-topics-listing bg-white shadow-lg mt-3 mb-3">
                <div class="row mb-3">
                    <div class="col-12 mx-auto text-center">
                        <h6>กรอกข้อมูลโครงการ</h6>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="formProject">
                    <div class="custom-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="project_name" id="project_name" class="form-control" placeholder="กรอกชื่อโครงการ">
                                    <label for="floatingInput">ชื่อโครงการ</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="project_owner" id="project_owner" class="form-control" placeholder="กรอกชื่อโครงการ">
                                    <label for="floatingInput">ชื่อเจ้าของโครงการ</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-floating">
                                    <select name="project_type" class="form-control">
                                        <option value="">เลือกประเภทโครงการ</option>
                                        <?php foreach ($project_type as $item) : ?>
                                            <option value="<?= $item['project_type_id']; ?>"><?= $item['project_type_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingInput">ประเภทโครงการ</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-floating">
                                    <select name="project_year" class="form-control" id="project_year">
                                        <option value="">ปี พ.ศ</option>
                                        <?php for ($i = 2560; $i <= intval(date("Y")) + 543; $i++) : ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <label for="floatingInput">ปีของโครงการ</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="form-floating">
                                <select name="project_class" class="form-control" id="project_class">
                                    <option value="">ระดับชั้น</option>
                                        <option value="">ปวช.</option>
                                            <option value="">ปวส.</option>
                                        </select>
                                    <label for="floatingInput">ระดับชั้น</label>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-12">
                                <hr />
                                <h6 class="text-center">รูปหน้าปกโครงการ <small style="font-size: 14px">(เป็นไฟล์นามสกุล .png .jpg เท่านั้น)</small></h6>
                                <div class="pt-2">
                                    <input type="file" name="project_cover" accept="image/png,image/jpg,image/jpeg" id="project_cover" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <hr />
                                <h6 class="text-center">แนบไฟล์โครงการ <small style="font-size: 14px">(เป็นไฟล์นามสกุล .pdf เท่านั้น)</small></h6>
                                <div class="pt-2">
                                    <label class="pl-1">ไฟล์ต้นฉบับ :</label>
                                    <input type="file" name="project_file" accept="application/pdf" id="project_file" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                 <label class="pl-1">บทนำ :</label>
                                 <input type="file" name="project_intro" accept="application/pdf" id="project_intro" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="pl-1">บทที่ 1 :</label>
                                <input type="file" name="project_chapter_1" accept="application/pdf" id="project_chappter_1" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="pl-1">บทที่ 2 :</label>
                                <input type="file" name="project_chapter_2" accept="application/pdf" id="project_chapter_2" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="pl-1">บทที่ 3 :</label>
                                <input type="file" name="project_chapter_3" accept="application/pdf" id="project_chapter_3" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="pl-1">บทที่ 4 :</label>
                                <input type="file" name="project_chapter_4" accept="application/pdf" id="project_chapter_4" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="pl-1">บทที่ 5 :</label>
                                <input type="file" name="project_chapter_5" accept="application/pdf" id="project_chapter_5" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="form-control">บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $('#formProject').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "./function/add_project.php", // Replace with your PHP script URL
            data: new FormData(this),
            dataType : 'JSON',
            contentType: false,
            processData: false,
            success: function(res) {
                console.log(res);
                if(res.status){
                    toast('success', 'สำเร็จ', res.message);
                    setTimeout(()=>{
                        window.location.assign('project.php');
                    },2000);
                }else{
                    toast('warning', 'แจ้งเตือน',res.message);
                }
                
            },
            error: function(err) {
                console.log("Error: " + err.responseText);
                toast('error', 'ผิดพลาด', err.responseText);
            }
        });
    })
</script>
<?php include dirname(__DIR__) . './template/footer.php'; ?>