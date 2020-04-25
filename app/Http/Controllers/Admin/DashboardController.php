<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Quark;
use DB;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $content = Quark::content();

        $content->row(function ($row) {

            $row->gutter([16, 24]);

            $row->col(6, function ($col) {
                $col->card(null, function ($card) {
                    $card->statistic('管理员数', function ($statistic) {
                        $count = DB::table('admins')->where('status',1)->where('deleted_at',null)->count();
                        $statistic->value($count)
                        ->precision(0)
                        ->valueStyle(['color' => '#3f8600']);
                    });
                });
            });
        
            $row->col(6, function ($col) {
                $col->card(null, function ($card) {
                    $card->statistic('日志数量', function ($statistic) {
                        $count = DB::table('action_logs')->where('status',1)->count();
                        $statistic->value($count)->precision(0)->valueStyle(['color' => '#999999']);
                    });
                });
            });

            $row->col(6, function ($col) {
                $col->card(null, function ($card) {
                    $card->statistic('图片数量', function ($statistic) {
                        $count = DB::table('pictures')->where('status',1)->count();
                        $statistic->value($count)->precision(0)->valueStyle(['color' => '#cf1322']);
                    });
                });
            });

            $row->col(6, function ($col) {
                $col->card(null, function ($card) {
                    $card->statistic('文件数量', function ($statistic) {
                        $count = DB::table('files')->where('status',1)->count();
                        $statistic->value($count)->precision(0)->valueStyle(['color' => '#cf1322']);
                    });
                });
            });
        });

        $content->row(function ($row) {

            $row->gutter([16, 24]);

            $row->col(12, function ($col) {
                $col->card('系统信息', function ($card) {

                    $columns = [
                        [
                            'title'=>'名称',
                            'dataIndex'=>'name',
                            'key'=>'name',
                        ],
                        [
                            'title'=>'信息',
                            'dataIndex'=>'info',
                            'key'=>'info',
                        ]
                    ];

                    if(strpos(PHP_OS,"Linux")!==false){
                        $os = "linux";
                    } else if(strpos(PHP_OS,"WIN")!==false){
                        $os = "windows";
                    }

                    $version = "version()";
                    $mysqlVersion = DB::select("select version()")[0]->$version;

                    $dataSource = [
                        [
                            'key'=> '1',
                            'name'=> 'QuarkAdmin版本',
                            'info'=> config('quark.admin.version'),
                        ],
                        [
                            'key'=> '2',
                            'name'=> '服务器操作系统',
                            'info'=> $os,
                        ],
                        [
                            'key'=> '3',
                            'name'=> 'Laravel版本',
                            'info'=> app()::VERSION,
                        ],
                        [
                            'key'=> '4',
                            'name'=> '运行环境',
                            'info'=> $_SERVER['SERVER_SOFTWARE'],
                        ],
                        [
                            'key'=> '5',
                            'name'=> 'MYSQL版本',
                            'info'=> $mysqlVersion,
                        ],
                        [
                            'key'=> '6',
                            'name'=> '上传限制',
                            'info'=> ini_get('upload_max_filesize'),
                        ],
                    ];

                    $card->table()
                    ->columns($columns)
                    ->showHeader(false)
                    ->pagination(false)
                    ->dataSource($dataSource)
                    ->size('small');
                });
            });
        
            $row->col(12, function ($col) {
                $col->card('产品团队', function ($card) {

                    $columns = [
                        [
                            'title'=>'名称',
                            'dataIndex'=>'name',
                            'key'=>'name',
                        ],
                        [
                            'title'=>'信息',
                            'dataIndex'=>'info',
                            'key'=>'info',
                        ]
                    ];

                    $dataSource = [
                        [
                            'key'=> '1',
                            'name'=> '作者',
                            'info'=> 'tangtanglove',
                        ],
                        [
                            'key'=> '2',
                            'name'=> '联系方式',
                            'info'=> 'dai_hang_love@126.com',
                        ],
                        [
                            'key'=> '3',
                            'name'=> '官方网址',
                            'info'=> 'www.quarkcms.com',
                        ],
                        [
                            'key'=> '4',
                            'name'=> '文档地址',
                            'info'=> 'www.quarkcms.com/doc',
                        ],
                        [
                            'key'=> '5',
                            'name'=> 'BUG反馈',
                            'info'=> 'https://github.com/quarkcms/quark-admin/issues',
                        ],
                        [
                            'key'=> '6',
                            'name'=> 'Github',
                            'info'=> 'https://github.com/quarkcms/quark-admin',
                        ]
                    ];

                    $card->table()
                    ->columns($columns)
                    ->showHeader(false)
                    ->pagination(false)
                    ->dataSource($dataSource)
                    ->size('small');
                });
            });
        });

        return success('获取成功！','',$content);
    }
}
