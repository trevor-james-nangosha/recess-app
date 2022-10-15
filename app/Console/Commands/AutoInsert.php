<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use mysqli;

class AutoInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command auto inserts registration information of the participant to the database.';

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

        $conn = new mysqli('127.0.0.1','nangosha','TREVORnangosha16@','recessDB', 3306);
        $file = fopen("files/participant.txt","r");

        while (!feof($file)) {
            $content = fgets($file);
            $carray = explode(",", $content);
            list($name, $password,$dob,$email) = $carray;
            $sql = "INSERT INTO `users`(`name`, `password`, `dateOfBirth`, `email`, `type`) VALUES ('$name', '$password',  '$dob', '$email', 'PARTICIPANT')";
            $conn->query($sql);
        } $another_file = fopen("files/participant.txt","w");
            fclose($another_file);

    }
}

// product
