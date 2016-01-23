
<!-- Minimap Root View -->
<script type="text/html" id="tmpl-bb-minimap">
    <div id="fl-minimap">
        <div class="fl-minimap-inside">
            <div class="fl-minimap-header">
                Layout
            </div>
            <div class="fl-minimap-rows"></div>
            <div class="fl-minimap-footer"></div>
        </div>
    </div>
</script>

<!-- Minimap Row -->
<script type="text/html" id="tmpl-bb-minimap-row">
    <div class="fl-minimap-row fl-node-{{data.node}}" data-node="{{data.node}}">
        <div class="fl-row-content-wrap">{{data.node}}</div>
    </div>
</script>
