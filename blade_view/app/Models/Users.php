<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function getAllUsers($filters = [], $keySearch = null, $sortArr = null, $perPage = 0)
    {
        //DB::enableQueryLog();
//        $user = DB::select('select * from users where flag_deleted = false order by create_at desc');
        $user = DB::table('users')
            ->select('users.*', 'groups.name as group_name')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->where('users.flag_deleted', '=', 0)
        ;

        if (!empty($filters)) {
            $user = $user->where($filters);
        }
        if (!empty($keySearch)) {
            $user = $user->where(function ($query) use ($keySearch) {
                $query->orWhere('fullname', 'like', '%' . $keySearch . '%');
                $query->orWhere('email', 'like', '%' . $keySearch . '%');
            });
        }

        $orderBy = 'users.create_at';
        $orderType = 'desc';

        if (!empty($sortArr) && is_array($sortArr)) {
            if (!empty($sortArr['sortBy']) && !empty($sortArr['sortType'])) {
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }

        $user = $user->orderBy($orderBy, $orderType);


        if (!empty($perPage)) {
            $user = $user->paginate($perPage)->withQueryString();// 4 records / 1 page
        } else {
            $user = $user->get();
        }
        //$sql = DB::getQueryLog();
        //dd($sql);
        return $user;
    }

    public function addUser($data)
    {
//        DB::insert('insert into users(fullname, email, create_at) values (?,?,?)', $data);
        return DB::table('users')->insert($data);

    }

    public function findById($id)
    {
//        return DB::select('select * from users where flag_deleted = false and id = ?', [$id]);
        return DB::table('users')
            ->select('users.*')
            ->where('flag_deleted', 0)
            ->where('id', $id)
            ->get();
    }

    public function updateUser($data, $id)
    {
//        $data = array_merge($data, [$id]);
//        return DB::update('update users set fullname=?, email=?, update_at=? where id = ?', $data);
        return DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteUser($id, $dataDelete)
    {
//        return DB::update('update users set flag_deleted = true where id = ?', [$id]);
        return DB::table('users')
            ->where('id', $id)
            ->update($dataDelete);
    }

    public function statementUser($sql)
    {
        return DB::statement($sql);
    }

    public function learnQueryBuilder()
    {
        // get all record
        $list = DB::table('users')->get();

        // get record first
        $first = DB::table('users')->first();

        // select column in table
//        $column = DB::table('users')->select('fullname', 'email')->get();
        $column = DB::table('users')->select('fullname as hovaten', 'email')->get();


        // query with where clause =
        $equalWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '=', 4)
            ->get();

        // query with where clause >, >=
        $bigWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '>', 2)
            ->get();

        // query with where clause <, <=
        $smallWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '<', 2)
            ->get();

        // query with where clause <> => !=
        $diffWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
//            ->where('id', '<>' , 2)
            ->where('id', '!=', 2)
            ->get();

        // query with where clause and
        $andWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
//            ->where('id', '>=' , 2)
//            ->where('id', '<=' , 3)
            ->where([
                [
                    'id', '>=', 2
                ],
                [
                    'id', '<=', 3
                ]
            ])
            ->get();

        // query with where clause or
        $orWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '=', 2)
            ->orWhere('id', '=', 3)
            ->get();

        // show query builder
        DB::enableQueryLog();

//        $showSql = DB::table('users')
//            ->select('fullname as hovaten', 'email')
//            ->where('id', '=' , 2)
//            ->orWhere('id', '=' , 3)
//            ->toSql();

        $showSql = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '=', 2)
            ->orWhere('id', '=', 3)
            ->get();

        DB::enableQueryLog();
//        dd(DB::getQueryLog());

        // query with where clause gom nhom
        $id = 4;
        $orWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('id', '=', 2)
            ->Where(function ($query) use ($id) {
//                $query ->where('id', '<', 3);
//                $query ->orWhere('id', '>', 3);
//                $query->where('id', '<', 4)->orWhere('id', '>', 4);
                $query->where('id', '<', $id)->orWhere('id', '>', $id);
            })
            ->get();


        // query search with like
        $likeWhere = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->where('fullname', 'like', '%Quoc%')
            ->get();

        // query with between
        $between = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereBetween('id', [2, 4])
            ->get();

        // query with not between
        $between = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereNotBetween('id', [2, 4])
            ->get();

        // query with in
        $in = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereIn('id', [2, 4])
            ->get();

        // query with not in
        $notIn = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereNotIn('id', [2, 4])
            ->get();

        // query with null
        $null = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereNull('update_at')
            ->get();

        // query with not null
        $notNull = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereNotNull('update_at')
            ->get();

        // query with date
        $date = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereDate('create_at', '2023-05-09')
            ->get();

        // query with month
        $month = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereMonth('create_at', '06')
            ->get();

        // query with day
        $day = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereDay('create_at', '09')
            ->get();

        // query with year
        $year = DB::table('users')
            ->select('fullname as hovaten', 'email')
            ->whereYear('create_at', '2022')
            ->get();

        // query value column
        $valueColumn = DB::table('users')
            ->select('fullname as hovaten', 'email')
//            ->whereColumn('create_at', 'update_at')
//            ->whereColumn('create_at','>' ,'update_at')
            ->whereColumn('create_at', '!=', 'update_at')
//            ->whereColumn([['create_at', '!=', 'update_at'],
//                ['firstname', '=', 'lastname']])
            ->get();

        // query inner join
        $join = DB::table('users')
            ->select('users.*', 'groups.name as groupname')
            ->join('groups', 'users.group_id', '=', 'groups.id')
            ->get();

        // query left join
        $left_join = DB::table('users')
            ->select('users.*', 'groups.name as groupname')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
            ->get();

        // query right join
        $right_join = DB::table('users')
            ->select('users.*', 'groups.name as groupname')
            ->rightJoin('groups', 'users.group_id', '=', 'groups.id')
            ->get();

        // query oder by
        $oder_by = DB::table('users')
            ->orderBy('create_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // query inRandomOrder
        $random_order = DB::table('users')
            ->inRandomOrder()
            ->get();


        // query group by - having
        $group_by = DB::table('users')
            ->select(DB::raw('count(id) as email_count'), 'email', 'fullname')
            ->groupBy('email')
            ->groupBy('fullname')
//            ->having('email_count', '>', 2)
            ->get();


        // query limit - offset
        $limit = DB::table('users')
            ->offset(3)
            ->limit(4)
            ->get();

        $limit = DB::table('users')
            ->skip(4)
            ->take(4)
            ->get();

        // query insert
//        $status = DB::table('users')->insert([
//            'fullname' => 'Ung Nhan',
//            'email' => 'ung@gmail.com',
//            'group_id' => 1,
//            'create_at' => date('Y-m-d H:i:s')
//        ]);

        // lay ra id sau khi insert
        $id = DB::getPdo()->lastInsertId();

//        $lastId = DB::table('users')->insertGetId([
//            'fullname' => 'Ung Nhan',
//            'email' => 'ung@gmail.com',
//            'group_id' => 1,
//            'create_at' => date('Y-m-d H:i:s')
//        ]);

        // query update
        // khong where se update tat ca record trong bang
        $statusUpdate = DB::table('users')
            ->where('id', 12)
            ->update([
                'fullname' => 'Quang Nhan',
                'email' => 'quangnhan@gmail.com',
                'group_id' => 2,
                'update_at' => date('Y-m-d H:i:s')
            ]);

        // query delete
        // khong where se delete tat ca record trong bang
        $statusDelete = DB::table('users')
            ->where('id', 14)
            ->delete();

        //dem so ban ghi
        $count = DB::table('users')->where('id', '>', 10)->count();

        // DB::raw() -> nen dung khi select
        $dbRaw = DB::table('users')
//            ->select(DB::raw('count(id) as email_count'), 'email')
            ->select(DB::raw('`fullname` as hoten,`email`'))
            ->where('id', '>', 10)
//            ->groupBy('email')
            ->get();

        // selectRaw()
        $dbRaw = DB::table('users')
//            ->select(DB::raw('count(id) as email_count'), 'email')
            ->selectRaw('fullname, email, count(id)')
//            ->where('id', '>', 10)
            ->groupBy('email')
            ->groupBy('fullname')
            ->get();

        // whereRaw() , orWhereRaw()
        $dbRaw = DB::table('users')
//            ->select(DB::raw('count(id) as email_count'), 'email')
            ->selectRaw('fullname, email')
            ->whereRaw('id > ?', 10)
            ->get();


        // orderByRaw()
        $dbRaw = DB::table('users')
//            ->select(DB::raw('count(id) as email_count'), 'email')
            ->selectRaw('fullname, email')
            ->orderByRaw('id DESC, update_at asc')
            ->get();


        // groupByRaw()
        $dbRaw = DB::table('users')
            ->selectRaw('count(id) as email_count, email, fullname')
            ->groupByRaw('email, fullname')
            ->get();

        // havingRaw()
        $dbRaw = DB::table('users')
            ->selectRaw('count(id) as email_count, email, fullname')
            ->groupByRaw('email, fullname')
            ->havingRaw('email_count > ?', [2])
            ->get();

        $dbRaw = DB::table('users')
            ->where(
                'group_id',
                '=',
                function ($query) {
                    $query->select('id')->from('groups')->where('name', '=', 'admin');
                }
            )
            ->get();

        $dbRaw = DB::table('users')
            ->select('email', DB::raw('(select count(id) from groups) as group_count'))
            ->get();

        $dbRaw = DB::table('users')
            ->selectRaw('email, (select count(id) from groups) as group_count')
            ->get();
//        dd($dbRaw);
    }
}
