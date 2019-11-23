## Gymkhana Portal

Add your own config.php in `php_action/config.php`
Run `init.sql` in your mysql db. If running in phpMyadmin, copy and paste the entire code sql entry field of phpMyAdmin localhost page (outside all the databases).  

## Main Admin: 
LoginID:  `admin1`  
Password:  `admin`  
You can add,edit,remove, control basically everything from this account. Or you can manually tackle with sql code.  

### config.php
```
<?php   

// echo "in config";

$root = "http://localhost:8888/Gymkhana/";
$localhost = "localhost";  //db location
$username = "root";  //your db username
$password = "root";  //your db password
$dbname = "Gymkhana";

// echo "out config";

?>
```
 
Invisible links to other login pages are at bottom right of any login page.  

## Images

### For Main Admin

![Screenshot 2019-04-23 at 2 59 50 PM](https://user-images.githubusercontent.com/29799995/56572745-4b7a6100-65dd-11e9-97d5-412d0e40a03a.png)
![Screenshot 2019-04-23 at 3 00 23 PM](https://user-images.githubusercontent.com/29799995/56572747-4c12f780-65dd-11e9-9003-68cc1fdd1e8f.png)
![Screenshot 2019-04-23 at 3 01 12 PM](https://user-images.githubusercontent.com/29799995/56572752-4cab8e00-65dd-11e9-90d4-20e530b76513.png)
![Screenshot 2019-04-23 at 3 01 52 PM](https://user-images.githubusercontent.com/29799995/56572755-4cab8e00-65dd-11e9-826b-3480c7ba9900.png)
![Screenshot 2019-04-23 at 3 02 11 PM](https://user-images.githubusercontent.com/29799995/56572757-4d442480-65dd-11e9-925c-14100a37700c.png)
![Screenshot 2019-04-23 at 3 02 33 PM](https://user-images.githubusercontent.com/29799995/56572758-4d442480-65dd-11e9-97e0-fd61202fdce1.png)
![Screenshot 2019-04-23 at 3 02 39 PM](https://user-images.githubusercontent.com/29799995/56572759-4d442480-65dd-11e9-973c-7f3bbe951f40.png)


### For Hostel Admin

![Screenshot 2019-04-23 at 3 36 08 PM](https://user-images.githubusercontent.com/29799995/56572880-8bd9df00-65dd-11e9-88a0-1868db0f926b.png)
![Screenshot 2019-04-23 at 3 06 20 PM](https://user-images.githubusercontent.com/29799995/56572924-9e541880-65dd-11e9-9900-bec0cdb7aee6.png)
![Screenshot 2019-04-23 at 3 07 20 PM](https://user-images.githubusercontent.com/29799995/56572926-9eecaf00-65dd-11e9-97db-60d28f01b27d.png)
![Screenshot 2019-04-23 at 3 27 06 PM](https://user-images.githubusercontent.com/29799995/56572928-9f854580-65dd-11e9-8142-85a594a7fd98.png)
![Screenshot 2019-04-23 at 3 28 45 PM](https://user-images.githubusercontent.com/29799995/56572930-9f854580-65dd-11e9-971f-a4e9c55c1f95.png)
![Screenshot 2019-04-23 at 3 28 59 PM](https://user-images.githubusercontent.com/29799995/56572931-a01ddc00-65dd-11e9-8e90-5c7bf2e6b6cd.png)


### For Student

![Screenshot 2019-04-23 at 3 38 07 PM](https://user-images.githubusercontent.com/29799995/56573013-d0657a80-65dd-11e9-81eb-901909f0b1ef.png)
![Screenshot 2019-04-23 at 3 30 10 PM](https://user-images.githubusercontent.com/29799995/56573021-d78c8880-65dd-11e9-9fab-a5757db007c9.png)
![Screenshot 2019-04-23 at 3 29 38 PM](https://user-images.githubusercontent.com/29799995/56573026-d8bdb580-65dd-11e9-9258-5c47076c75b7.png)
![Screenshot 2019-04-23 at 3 30 17 PM](https://user-images.githubusercontent.com/29799995/56573045-e410e100-65dd-11e9-969b-595b4cc40273.png)
![Screenshot 2019-04-23 at 3 30 25 PM](https://user-images.githubusercontent.com/29799995/56573046-e4a97780-65dd-11e9-8304-968f9fd49fb6.png)
![Screenshot 2019-04-23 at 3 30 32 PM](https://user-images.githubusercontent.com/29799995/56573047-e4a97780-65dd-11e9-855a-6027c17a90cd.png)


## Details
Have a look at our [presentation](16CS01042_41_DS_Lab_Project_Gims.pptx) for more details on features, implementation etc.
