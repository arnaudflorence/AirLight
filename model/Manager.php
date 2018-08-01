<?php

// A SQL implementation
class SQL_Connect
{
// Attributes
    // Connection data
    private             $_host;
    private             $_user;
    private             $_password;

    // Base data
    private                 $_dbaseName = NULL;
    private                 $_dbaseClass = NULL;

// Construct/Destruct
    public function __construct($host = "phpmyadmin.elan-formation.eu",
                                $user = "a_florence",
                                $password = "elanformation67")
    {
        $this->_host =      $host;
        $this->_user =      $user;
        $this->_password =  $password;
    }
    public function __destruct()
    {
    }

// Members
    public function connect($to)
    {
        try
        {
            $this->_dbaseName = $to;
            $this->_dbaseClass = new PDO('mysql:host=' .
                                        $this->_host .
                                        ';dbname=' .
                                        $this->_dbaseName .
                                        ';charset=UTF8;',
                                        $this->_user, $this->_password);
            $this->_dbaseClass->setAttribute(PDO::ATTR_ERRMODE,
                                            PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex)
        {
            echo 'Connection error<br>Error message [' .
                    $ex->getMessage() . "]<br>";
        }
    }
    
    public function ask($command)
    {
        $tmpAnswer = $this->_dbaseClass->query($command);
        $answer = $tmpAnswer->fetchAll();
        $tmpAnswer->closecursor();
        return ($answer);
    }
    
    public function set($command)
    {
        $this->_dbaseClass->query($command);
    }
}