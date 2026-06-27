<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Reply;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tenantId = 1;
        $admin = User::where('email', 'admin@acme.com')->first();
        $agent1 = User::where('email', 'agent1@acme.com')->first();
        $agent2 = User::where('email', 'agent2@acme.com')->first();
        $customer1 = User::where('email', 'customer1@acme.com')->first();
        $customer2 = User::where('email', 'customer2@acme.com')->first();

        $ticketData = [
            // Customer 1 tickets
            [
                'title' => 'Unable to login to account',
                'description' => 'I keep getting an invalid password error when trying to login.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'in_progress',
                'priority' => 'high',
            ],
            [
                'title' => 'Feature request: dark mode',
                'description' => 'Please add a dark mode option to the dashboard interface.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'open',
                'priority' => 'low',
            ],
            [
                'title' => 'Billing inquiry',
                'description' => 'I have a question about my last invoice.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'resolved',
                'priority' => 'medium',
            ],
            [
                'title' => 'API documentation error',
                'description' => 'There is a typo in the API documentation for the user endpoint.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'resolved',
                'priority' => 'low',
            ],
            [
                'title' => 'Performance issue',
                'description' => 'The dashboard is loading very slowly today.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'open',
                'priority' => 'high',
            ],
            [
                'title' => 'Export not working',
                'description' => 'I cannot export my data to CSV format.',
                'user_id' => $customer1->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'in_progress',
                'priority' => 'medium',
            ],
            // Customer 2 tickets
            [
                'title' => 'Email notifications not received',
                'description' => 'I am not receiving email notifications for new tickets.',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'open',
                'priority' => 'medium',
            ],
            [
                'title' => 'Change subscription plan',
                'description' => 'I would like to upgrade my subscription plan.',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'in_progress',
                'priority' => 'high',
            ],
            [
                'title' => 'Mobile app crash',
                'description' => 'The mobile app crashes when I try to view my profile.',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'open',
                'priority' => 'high',
            ],
            [
                'title' => 'Password reset link expired',
                'description' => 'The password reset link I received was already expired.',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'resolved',
                'priority' => 'medium',
            ],
            [
                'title' => 'Upload file size limit',
                'description' => 'What is the maximum file size I can upload?',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent1->id,
                'status' => 'resolved',
                'priority' => 'low',
            ],
            [
                'title' => 'Integration with Slack',
                'description' => 'Can we integrate with Slack for notifications?',
                'user_id' => $customer2->id,
                'assigned_agent_id' => $agent2->id,
                'status' => 'open',
                'priority' => 'medium',
            ],
        ];

        $tickets = [];
        foreach ($ticketData as $data) {
            $ticket = Ticket::create([
                ...$data,
                'tenant_id' => $tenantId,
            ]);
            $tickets[] = $ticket;
        }

        // Create replies for each ticket
        foreach ($tickets as $ticket) {
            // First reply from the customer
            Reply::create([
                'body' => 'Thank you for looking into this.',
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->user_id,
                'tenant_id' => $tenantId,
            ]);

            // Second reply from the assigned agent
            Reply::create([
                'body' => 'Thanks for reporting this. We are working on it and will update you shortly.',
                'ticket_id' => $ticket->id,
                'user_id' => $ticket->assigned_agent_id,
                'tenant_id' => $tenantId,
            ]);

            // Add a third reply for some tickets
            if ($ticket->id % 3 == 0) {
                Reply::create([
                    'body' => 'Any updates on this issue?',
                    'ticket_id' => $ticket->id,
                    'user_id' => $ticket->user_id,
                    'tenant_id' => $tenantId,
                ]);
            }
        }
    }
}