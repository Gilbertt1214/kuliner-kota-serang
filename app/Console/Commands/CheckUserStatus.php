<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserStatus extends Command
{
  protected $signature = 'user:check {name}';
  protected $description = 'Check user suspension status';

  public function handle()
  {
    $name = $this->argument('name');
    $user = User::where('name', $name)->first();

    if (!$user) {
      $this->error("User '{$name}' not found");
      return;
    }

    $this->info("User Details:");
    $this->line("Name: {$user->name}");
    $this->line("Email: {$user->email}");
    $this->line("Role: {$user->role}");
    $this->line("Is Suspended: " . ($user->is_suspended ? 'Yes' : 'No'));
    $this->line("Suspended Until: " . ($user->suspended_until ?? 'Permanent/Not set'));
    $this->line("Suspension Reason: " . ($user->suspension_reason ?? 'None'));
    $this->line("Warning Count: " . ($user->warning_count ?? 0));
    $this->line("isSuspended() method returns: " . ($user->isSuspended() ? 'true' : 'false'));
  }
}
