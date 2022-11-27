@component('mail::message')
# Introduction

The body of your message. {{ $event->member->name }}

@component('mail::table')
|  		    สินค้า        ||  จำนวน  |   ราคา   |   รวม   |
|:------:|-------------- |:-------:| :-------:|:-------:|
|  img	 | ชื่อสินค้า ขนาด   |    1    |     10   |	   10	|
|  img   | ชื่อสินค้า ขนาด   |    2    |  	 20   |    40	| 
|--------------------------------------:| | | |:-------:|
|				ยอดรวม					| | | |    40	|
|--------------------------------------:| | | |:-------:|
|     			รวมทั้งหมด				| | | |    30	|
|--------------------------------------:| | | |:-------:|
@endcomponent

<br>หมายเหตุ

<br>รายละเอียดการชำระเงิน

<br>แจ้งชำระเงิน

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
