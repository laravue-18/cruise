<template>
    <div class="border-b" :class="{'border-[#FF9900]': isActive}">
        <div class="flex items-center justify-between" @click="toggle">
            <slot></slot>
            <Icon :type="isActive ? 'md-remove': 'md-add'" size="24" class="mr-8" :class="{'text-[#FF9900]': isActive}"></Icon>
        </div>
        <collapse-transition v-if="mounted">
            <div v-show="isActive">
                <div><slot name="content"></slot></div>
            </div>
        </collapse-transition>
    </div>
</template>
<script>
    import CollapseTransition from '../base/collapse-transition.vue';
    const prefixCls = 'ivu-collapse';

    export default {
        name: 'Panel',
        components: { CollapseTransition },
        inject: ['CollapseInstance'],
        props: {
            name: {
                type: String
            },
            hideArrow: {
                type: Boolean,
                default: false
            }
        },
        data () {
            return {
                index: 0, // use index for default when name is null
                mounted: false
            };
        },
        computed: {
            itemClasses () {
                return [
                    `${prefixCls}-item`,
                    {
                        [`${prefixCls}-item-active`]: this.isActive
                    }
                ];
            },
            headerClasses () {
                return `${prefixCls}-header`;
            },
            contentClasses () {
                return `${prefixCls}-content`;
            },
            boxClasses () {
                return `${prefixCls}-content-box`;
            },
            isActive () {
                const activeKey = this.CollapseInstance.getActiveKey();
                const name = this.name || this.index.toString();
                return activeKey.indexOf(name) > -1;
            }
        },
        methods: {
            setIndex () {
                this.index = this.CollapseInstance.panelCount + 1;
                this.CollapseInstance.panelCount = this.index;
            },
            toggle () {
                this.CollapseInstance.toggle({
                    name: this.name || this.index,
                    isActive: this.isActive
                });
            }
        },
        mounted () {
            this.setIndex();
            this.mounted = true;
        }
    };
</script>
