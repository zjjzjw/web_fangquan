<?php

use Illuminate\Database\Seeder;
use App\Src\Role\Infra\Eloquent\UserModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = $this->getData();
        foreach ($items as $item) {
            $user_model = UserModel::find($item['id']);
            if (!isset($user_model)) {
                $user_model = new UserModel();
                $user_model->id = $item['id'];
            }
            $user_model->account = $item['account'];
            $user_model->company_id = $item['company_id'];
            $user_model->company_name = $item['company_name'];
            $user_model->employee_id = $item['employee_id'];
            $user_model->position = $item['position'];
            $user_model->name = $item['name'];
            $user_model->email = $item['email'];
            $user_model->phone = $item['phone'];
            $user_model->password = $item['password'];
            $user_model->status = $item['status'];
            $user_model->type = $item['type'];
            $user_model->created_user_id = $item['created_user_id'];
            $user_model->save();
        }
    }

    private function getData()
    {
        return [
            [
                'id'              => 1,
                'account'         => '王志勇',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0001',
                'position'        => 'CEO',
                'name'            => '王志勇',
                'email'           => 'peter@fq960.com',
                'phone'           => '13817749797',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 2,
                'account'         => '宋牧青',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0002',
                'position'        => 'COO',
                'name'            => '宋牧青',
                'email'           => 'biu@fq960.com',
                'phone'           => '18621183131',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 3,
                'account'         => '项圣接',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0003',
                'position'        => '行政经理',
                'name'            => '项圣接',
                'email'           => 'rita.xiang@fq960.com',
                'phone'           => '15268540070',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 4,
                'account'         => '朱敏',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0006',
                'position'        => '财务经理',
                'name'            => '朱敏',
                'email'           => 'danny.zhu@fq960.com',
                'phone'           => '13774242488',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 5,
                'account'         => '沈红兰',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0030',
                'position'        => '人事经理',
                'name'            => '沈红兰',
                'email'           => 'hl.shen@fq960.com',
                'phone'           => '18516211580',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 6,
                'account'         => '陈博',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0009',
                'position'        => '产品经理',
                'name'            => '陈博',
                'email'           => 'bo.chen@fq960.com',
                'phone'           => '18739931611',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 7,
                'account'         => '王诗咏',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0010',
                'position'        => '测试工程师',
                'name'            => '王诗咏',
                'email'           => 'shiyong.wang@fq960.com',
                'phone'           => '15038319279',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 8,
                'account'         => '郭庆',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0012',
                'position'        => 'PHP工程师',
                'name'            => '郭庆',
                'email'           => 'qing.guo@fq960.com',
                'phone'           => '13120998373',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 9,
                'account'         => '龙香菊',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0016',
                'position'        => 'UI设计师',
                'name'            => '龙香菊',
                'email'           => 'xj.long@fq960.com',
                'phone'           => '13681687756',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 10,
                'account'         => '张甜',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0033',
                'position'        => '网站编辑',
                'name'            => '张甜',
                'email'           => 't.zhang@fq960.com',
                'phone'           => '13201752885',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 11,
                'account'         => '姜立祥',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0017',
                'position'        => 'PHP工程师',
                'name'            => '姜立祥',
                'email'           => 'lixiang.jiang@fq960.com',
                'phone'           => '13761577991',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 12,
                'account'         => '王晓北',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0018',
                'position'        => 'PHP工程师',
                'name'            => '王晓北',
                'email'           => 'xiaobei.wang@fq960.com',
                'phone'           => '17135502300',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 13,
                'account'         => '董搏谨',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0019',
                'position'        => '出纳兼行政',
                'name'            => '董搏谨',
                'email'           => 'bojin.dong@fq960.com',
                'phone'           => '18945051758',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 14,
                'account'         => '沈丽华',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0022',
                'position'        => '前端工程师',
                'name'            => '沈丽华',
                'email'           => 'lh.shen@fq960.com',
                'phone'           => '17701686258',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 15,
                'account'         => '孙红玉',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0023',
                'position'        => '高级PHP工程师',
                'name'            => '孙红玉',
                'email'           => 'hongyu.sun@fq960.com',
                'phone'           => '13816958237',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 16,
                'account'         => '刘恒伟',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0027',
                'position'        => '爬虫工程师',
                'name'            => '刘恒伟',
                'email'           => 'hw.liu@fq960.com',
                'phone'           => '13105279055',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 17,
                'account'         => '邹程刚',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0029',
                'position'        => 'UI设计师',
                'name'            => '邹程刚',
                'email'           => 'cg.zou@fq960.com',
                'phone'           => '13591367450',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 18,
                'account'         => '张涛',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0038',
                'position'        => '产品经理',
                'name'            => '张涛',
                'email'           => 'tao.zhang@fq960.com',
                'phone'           => '13795425899',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 19,
                'account'         => '周贵',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0034',
                'position'        => '运维工程师',
                'name'            => '周贵',
                'email'           => 'g.zhou@fq960.com',
                'phone'           => '15056221705',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 20,
                'account'         => '王春杰',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0039',
                'position'        => 'IOS开发工程师',
                'name'            => '王春杰',
                'email'           => 'cj.wang@fq960.com',
                'phone'           => '13592615175',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 21,
                'account'         => '杨琼',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0041',
                'position'        => '客服经理',
                'name'            => '杨琼',
                'email'           => 'q.yang@fq960.com',
                'phone'           => '18502181599',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 22,
                'account'         => '宋祥',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0040',
                'position'        => 'PHP工程师',
                'name'            => '宋祥',
                'email'           => 'x.song@fq960.com',
                'phone'           => '18296655625',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 23,
                'account'         => '刘所柱',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0043',
                'position'        => 'Android工程师',
                'name'            => '刘所柱',
                'email'           => 'sz.liu@fq960.com',
                'phone'           => '15037207037',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
            [
                'id'              => 24,
                'account'         => '孔祥强',
                'company_id'      => 1,
                'company_name'    => '上海绘房信息科技有限公司',
                'employee_id'     => 'FQ0045',
                'position'        => '爬虫工程师',
                'name'            => '孔祥强',
                'email'           => 'xq.kong@fq960.com',
                'phone'           => '13761631397',
                'password'        => '5f1d7a84db00d2fce00b31a7fc73224f',
                'status'          => 1,
                'type'            => 1,
                'created_user_id' => 1,
            ],
        ];
    }
}