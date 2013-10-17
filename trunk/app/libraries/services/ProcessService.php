<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 16/10/13
 * Time: 1:49 PM
 * To change this template use File | Settings | File Templates.
 */

class ProcessService
{

    public function isProcessRunning($pid)
    {
        // create our system command
        $cmd = "ps $pid";

        // run the system command and assign output to a variable ($output)
        exec($cmd, $output, $result);

        // check the number of lines that were returned
        if (count($output) >= 2) {

            // the process is still alive
            return true;
        }

        // the process is dead
        return false;
    }

    public function killProcess($pid)
    {
        $cmd = "kill $pid";

        exec($cmd);

    }
}