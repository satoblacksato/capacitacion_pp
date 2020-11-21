<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\User;
use App\Notifications\SendEmailToAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Book;

class SendTotalsAndNewBook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book=$book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categoryName=(Category::findOrFail($this->book->category_id))->name;
        $bookCount=Book::where('category_id','=',$this->book->category_id)->count();

        (User::findOrFail(11))->notify(new SendEmailToAdmin($categoryName,$bookCount));
    }
}
