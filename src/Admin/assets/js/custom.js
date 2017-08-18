/**
 * 删除项目
 *
 * @param id
 * @param url
 * @param token
 */
function itemDelete(id, url, token) {
    bootbox.confirm({
        title: "删除",
        message: "该操作无法恢复，是否确认删除？",
        buttons: {
            cancel: { label: '<i class="fa fa-times"></i> 取消' },
            confirm: { label: '<i class="fa fa-check"></i> 确定' }
        },
        callback: function (result) {
            if (!result) return;
            layer.load(2);

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token } });
            $.ajax({
                url: url,
                type: 'DELETE',
                data: { id: id },
                dataType: 'json',
                success: function (data) {
                    layer.closeAll('loading');
                    if (data.code) {
                        layer.msg(data.error);
                        return;
                    }
                    window.location.reload();
                },
                error: function () {
                    layer.closeAll('loading');
                    layer.msg('网络错误');
                }
            });
        }
    });
}