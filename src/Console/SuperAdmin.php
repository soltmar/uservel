<?php

namespace marsoltys\uservel\Console;

use Illuminate\Console\Command;

class SuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:superadmin {user : Username of the user} {--revoke : Removes superuser role for provided user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds or removes superadmin role for the user';

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
     * @return mixed
     */
    public function handle()
    {
        $remove = $this->option('revoke');
        $user = $this->argument('user');

        try {
        $user = \User::where('username', $user)->firstOrFail();
        } catch (\Exception $e) {
            $this->error('User doesn\'t exists');
            exit(1);
        }

        if ($remove) {
            if ($this->confirm("Do you really want to revoke superadmin role for  $user->username")) {
                $user->superadmin = false;
                if ($user->save()) {
                    $this->info("{$user->username} is not superadmin anymore.");
                    exit(1);
                }
            }
        } else {
            if ($this->confirm("Do you really want to assign superadmin role to  $user->username")) {
                $user->superadmin = true;
                if ($user->save()) {
                    $this->info("{$user->username} is superadmin now.");
                    exit(1);
                }
            }
        }
    }
}
