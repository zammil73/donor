<?php $title = "Donor List"; 
include "header.php" ?>
<div class="content">
    <div class="container-xl container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="my-profile">
                    <div class="card" style="background-color:transparent;border:none;">
                        <div class="card-header mb-4 bg-white">
                            <h3 class="card-title d-inline-block mb-0">Donor List</h3>
                            <a href="index.php" class="btn btn1 btn-sm float-right">Change City / Blood Group</a>
                        </div>
                        
                        <?php 
                            $db = new Database();
                            $limit = 10;
                            $city = $_GET['city']; 
                            $blood_group = $_GET['blood_group'];
                            $db->select('donor','donor.id,donor.donor_img,donor.donor_name,donor.gender,donor.email,donor.phone,
                                        donor.address,donor.pin_code,donor.city,donor.state,donor.country,donor.blood_group,blood_group.name',
                                        "blood_group ON donor.blood_group = blood_group.id",
                                        "city='{$city}' AND blood_group='{$blood_group}'",null,$limit);
                            $result = $db->getResult();
                            if(count($result) > 0){
                                foreach($result as $row){
                        ?>
                        <div class="card-body bg-white mb-4">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-5">
                                    <div class="user-img">
                                        <?php
                                            if($row['donor_img'] != ''){ ?>
                                                <img src="./admin/images/donor/<?php echo $row['donor_img']; ?>" alt="">
                                            <?php }else{ ?>
                                                <img src="./admin/images/donor/user.jpg"  alt="">
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-7">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b>Full Name:</b></td>
                                                <td><?php echo $row['donor_name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Blood Group:</b></td>
                                                <td><?php echo $row['name'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php if(isset($_SESSION['id'])){ ?>
                                        <a href="donor-profile.php?doid=<?php echo $row['id']; ?>" class="btn btn1">Get Contact</a>
                                    <?php }else{ ?>
                                        <a href="user-login.php" class="btn btn1 mb-1">Get Contact</a>
                                        <small class="mx-2 mb-0 d-block">If you want more details about this donor please login with your account.</small>
                                    <?php } ?>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            
                        </div>
                        <?php } ?>  
                        <?php  }else { ?>
                                <h3 class="bg-white p-3">No Record Found</h3>
                        <?php } ?>
                        <div class="pagination-outer">
                        <?php 
                            echo $db->pagination('donor',null,"city='{$city}' AND blood_group='{$blood_group}'",$limit,"donor.php?city={$city}&blood_group={$blood_group}&");
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>