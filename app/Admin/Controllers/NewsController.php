<?php

namespace App\Admin\Controllers;

use App\NodeInfo;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class NewsController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('帮助');
            $content->description('用来给提供展示帮助/公告等信息');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('修改帮助');
            $content->description('修改帮助的内容或状态（停用的帮助将不会再显示）');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建帮助');
            $content->description('新建的帮助(状态：启用)，会通过API直接暴露到调用了接口的列表中。');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(NodeInfo::class, function (Grid $grid) {
            $grid->disableRowSelector();
            $grid->disableFilter();
            $grid->disableExport();

            $grid->id('ID')->sortable();

            $grid->column('title', '标题')->editable();
            $grid->column('language', '语言')->editable('select', [
                'en' => 'English',
                'cn' => '中文'
            ]);
            $grid->column('type', '类型')->editable('select', [
                'Identity' => '身份',
                'Wallet' => '钱包',
                'Others' => '其他'
            ]);
            $grid->column('status', '状态')->editable('select', [
                '1' => '启用',
                '0' => '禁用'
            ]);

            $grid->column('updated_at', '最后更新');

            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(NodeInfo::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('title', '标题');
            $form->editor('content', '内容');
            $form->select('language', '语言')->options([
                'en' => 'English',
                'cn' => '中文'
            ])->default('en');
            $form->select('type', '类型')->options([
                'Identity' => '身份',
                'Wallet' => '钱包',
                'Others' => '其他'
            ])->default('Others');
            $form->select('status', '状态')->options([
                '1' => '启用',
                '0' => '禁用'
            ])->default('1');

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
