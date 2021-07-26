<!-- 入力方法モーダルの設定 -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="questionModalLabel">入力方法</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <p>キャラクターシート作成サービスを利用して作成したキャラクターのURLを、ドメインとそれ以下に分けて入力してください。</p>
                        <p>現在、以下のキャラクターシート作成サービスに対応しています。</p>
                        <ul>
                            @foreach(CharacterConsts::SERVICE_DOMAIN_LIST as $key => $value)
                            <li>{{ CharacterConsts::SERVICE_LIST[$key] }}（{{ $value }}）</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
            </div><!-- /.modal-footer -->
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
