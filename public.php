public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('car');
        $table->date('date');
        $table->timestamps();
    });
}
