<?php
function cpu_usage1($webvmhost_ip,$webvmhost_user,$webvmhost_password)
    {
        $load = null;
        $cmd = "cpu";
        $host_ip = $webvmhost_ip;
        $host_user = $webvmhost_user;
        $host_password = $webvmhost_password;

        if (stristr(PHP_OS, "win"))
        {
            $cmd = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\loadstatus\loadstatus.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password);
            $shell = explode('LoadPercentage ',$cmd);
            return (int)$shell[1];
        }

        return $load;
    }
    function cpu_usage($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name)
    {
        $load = null;
        $cmd = "loadstatus";
        $host_ip = $webvmhost_ip;
        $host_user = $webvmhost_user;
        $host_password = $webvmhost_password;
        $vm_name = $webvm_name;
        $vm_user = JAPANSYS;
        $vm_pass = JAPANSYS_PASS;
        $vm_action = "cpu";

        if (stristr(PHP_OS, "win"))
        {
            $cmd = shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
            $shell = explode('LoadPercentage ',$cmd);
            return (int)$shell[1];
        }

        return $load;
    }

    function memory_usage($getPercentage=true,$webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name)
    {
        $memoryTotal = null;
        $memoryFree = null;
        $cmd = "loadstatus";
        $host_ip = $webvmhost_ip;
        $host_user = $webvmhost_user;
        $host_password = $webvmhost_password;
        $vm_name = $webvm_name;
        $vm_user = JAPANSYS;
        $vm_pass = JAPANSYS_PASS;
        // $vm_action = "ramt";

        if ( stristr(PHP_OS, "win")) 
        {
            // Get total physical memory (this is in bytes)
            $shell =shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$cmd);;
            $shell = trim(preg_replace('/\s\s+/', ' ', $shell));
            $shell = preg_replace('/\s+/', '', $shell);
            $shell = explode("r_r",$shell);
            $outputTotalPhysicalMemory = explode("TotalPhysicalMemory",$shell[0]);
            $memoryTotal=(int)$outputTotalPhysicalMemory[1];
            $outputFreePhysicalMemory = explode("FreePhysicalMemory",$shell[1]);
            $memoryFree=(int)$outputFreePhysicalMemory[1];

            // if ($outputTotalPhysicalMemory && $outputFreePhysicalMemory) {
            //     // Find total value
            //     foreach ($outputTotalPhysicalMemory as $line) {
            //         if ($line && preg_match("/^[0-9]+\$/", $line)) {
            //             $memoryTotal = $line;
            //             break;
            //         }
            //     }

            //     // Find free value
            //     foreach ($outputFreePhysicalMemory as $line) {
            //         if ($line && preg_match("/^[0-9]+\$/", $line)) {
            //             $memoryFree = $line;
            //             $memoryFree *= 1024;  // convert from kibibytes to bytes
            //             break;
            //         }
            //     }
            // }
        }
        if (is_null($memoryTotal) || is_null($memoryFree)) 
        {
            return null;
        } else 
        {
            if ($getPercentage) 
            {
                return round((100 - ((int)$memoryFree * 1024 * 100 / (int)$memoryTotal)),2);
            } else 
            {
                return array(
                    "total" => $memoryTotal,
                    "free" => $memoryFree,
                );
            }
        }
    }
    function disk_read($webvmhost_ip,$webvmhost_user,$webvmhost_password,$webvm_name)
    {
        $load = null;
        $cmd = "loadstatus";
        $host_ip = $webvmhost_ip;
        $host_user = $webvmhost_user;
        $host_password = $webvmhost_password;
        $vm_name = $webvm_name;
        $vm_user = JAPANSYS;
        $vm_pass = JAPANSYS_PASS;
        $vm_action = "disk_rw";

        if (stristr(PHP_OS, "win"))
        {
            $shell =shell_exec('powershell.exe -executionpolicy bypass -NoProfile -File "E:\scripts\firewall\change_fw_init.ps1" '.$cmd.' '.$host_ip.' '.$host_user.' '.$host_password.' '.$vm_name.' '.$vm_user.' '.$vm_pass.' '.$vm_action);
            return round($shell,2);
        }

        return $load;
    }