<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use mysqli;

class AutoInsertProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Auto:InsertProduct';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command auto inserts product information of the participant to the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $conn = new mysqli('127.0.0.1:3306','nangosha','TREVORnangosha16@','recessDB');
        $file = fopen("files/product.txt","r");

        while (!feof($file)) {
            $content = fgets($file);
            $carray = explode(",", $content);
            list($productName,$description,$qty,$rate) = $carray;
            $sql = "INSERT INTO `products`(`name`, `description`, `totalQuantityPosted`, `ratePerItem`) VALUES ('$productName','$description','$qty','$rate')";
            $conn->query($sql);
        } $another_file = fopen("files/product.txt","w");
            fclose($another_file);


    }
}
