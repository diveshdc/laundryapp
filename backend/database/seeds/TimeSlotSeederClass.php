<?php

use Illuminate\Database\Seeder;
use App\AdminTimeSlot;

class TimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeSlot = [
        	[
            'id'=> 1,
            'date'=>'2020-08-01',
            'start_time'=>'07:00',
            'end_time'=>'08:00 AM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 2,
            'date'=>'2020-08-01',
            'start_time'=>'08:00',
            'end_time'=>'09:00 AM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 3,
            'date'=>'2020-08-01',
            'start_time'=>'09:00',
            'end_time'=>'10:00 AM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 4,
            'date'=>'2020-08-01',
            'start_time'=>'10:00 ',
            'end_time'=>'11:00 AM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 5,
            'date'=>'2020-08-01',
            'start_time'=>'11:00',
            'end_time'=>'12:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 6,
            'date'=>'2020-08-01',
            'start_time'=>'12:00',
            'end_time'=>'13:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 7,
            'date'=>'2020-08-01',
            'start_time'=>'13:00',
            'end_time'=>'14:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 8,
            'date'=>'2020-08-01',
            'start_time'=>'14:00',
            'end_time'=>'15:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 9,
            'date'=>'2020-08-01',
            'start_time'=>'15:00',
            'end_time'=>'16:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 10,
            'date'=>'2020-08-01',
            'start_time'=>'16:00',
            'end_time'=>'17:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 11,
            'date'=>'2020-08-01',
            'start_time'=>'17:00',
            'end_time'=>'18:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 12,
            'date'=>'2020-08-01',
            'start_time'=>'18:00',
            'end_time'=>'19:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 13,
            'date'=>'2020-08-01',
            'start_time'=>'19:00',
            'end_time'=>'20:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 14,
            'date'=>'2020-08-01',
            'start_time'=>'20:00',
            'end_time'=>'21:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 15,
            'date'=>'2020-08-01',
            'start_time'=>'21:00',
            'end_time'=>'22:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	[
            'id'=> 16,
            'date'=>'2020-08-01',
            'start_time'=>'22:00',
            'end_time'=>'23:00 PM',
            'maximum_order'=>'4',
            'delivery_period'=>'48'
        	],
        	
        ];

        AdminTimeSlot::insert($timeSlot);
    }
}
