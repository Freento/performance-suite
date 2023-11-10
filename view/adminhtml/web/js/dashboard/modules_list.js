define([
    'ko',
    'uiComponent',
    'jquery',
    'mage/url',
], function (ko, Component, $, urlBuilder) {
    'use strict';

    return Component.extend({
        defaults: {
            buttonLabel: '',
            template: 'Freento_PerformanceSuite/dashboard/modules_list',
            ajaxUrl: '',
            data: ko.observable([]),
            loaded: false
        },

        initialize: function () {
            this._super();
            this.load();
        },

        hasInstalledModules: function () {
            return Array.isArray(this._getInstalledModules()) && this._getInstalledModules().length;
        },

        getInstalledModules: function () {
            return this._getInstalledModules();
        },

        hasAvailableModules: function () {
            return Array.isArray(this._getAvailableModules()) && this._getAvailableModules().length;
        },

        getAvailableModules: function () {
            return this._getAvailableModules()
        },

        _getInstalledModules()
        {
            return this._getData().filter((module) => module.installed_version);
        },

        _getAvailableModules()
        {
            return this._getData().filter((module) => !module.installed_version);
        },

        _getData: function () {
            if (!this.loaded) {
                this.load();
                this.loaded = true;
            }

            return this.data();
        },

        load: function () {
            self = this;
            $.ajax({
                type: 'get',
                url: this.ajaxUrl,
                dataType: 'json',
                success: function (data) {
                    self.data(data);
                },
                error: function (xhr, status, error) {
                    self.data([]);
                }
            });
        }
    });
});
