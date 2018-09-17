// Register the following element definition with the builder
Builder.types.post_grid = {

	// Label in the interface
	title: 'Post Grid',

	// Icon in `New element` dialog
	icon: '/wp-content/themes/testing-ground/builder/post-grid/icon.svg',

	// Icon in builder overview
	iconSmall: '/wp-content/themes/testing-ground/builder/post-grid/icon-small.svg',

	// Show in `New element` dialog
	element: true,

	// Includes required functionality from the Builder
	mixins: [Builder.entity, Builder.element, Builder.container],

	// A function that returns a JS object which is then used to render the interface
	// Params are the currently stored parameters for this element
	params: function (params) {

		// Just for easier access later on
		var element = params.element;

		return {
			width: 500,
			tabs: [{
				title: "Content",
				fields: {
					query: {
                        label: "Query Arguments",
						description : "Please enter the query parameters in JSON format using the <a href='https://crocoblock.com/wp-query-generator/' target='_blank'>tool for creating custom WordPress queries.</a>",
						type: "textarea",
						attrs: {
							rows: 5,
							placeholder: '{"post_type":"post"}'
						}
					},
					show_title: {
						label: "Display",
						type: "checkbox",
						text: "Show the title"
					},
					show_meta: {
						type: "checkbox",
						text: "Show the meta text"
					},
					show_image: {
						type: "checkbox",
						text: "Show the image"
					},
					show_content: {
						type: "checkbox",
						text: "Show the content"
					},
					show_link: {
						description: "Show or hide content fields without the need to delete the content itself.",
						type: "checkbox",
						text: "Show the link"
					}
				}
			}, {
				title: "Settings",
				fields: {
					_grid: {
						label: "Grid",
						divider: !0,
						type: "group",
						fields: {
							grid_masonry: {
								label: "Masonry",
								description: "The masonry effect creates a layout free of gaps even if grid cells have different heights. ",
								type: "checkbox",
								text: "Enable masonry effect"
							},
							grid_parallax: {
								label: "Parallax",
								description: "The parallax effect moves single grid columns at different speeds while scrolling. Define the vertical parallax offset in pixels.",
								type: "range",
								attrs: {
									min: 0,
									max: 600,
									step: 10
								}
							},
							gutter: {
								label: "Gutter",
								description: "Set the grid gutter width and display dividers between grid cells.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Medium: "medium",
									Default: "",
									Large: "large",
									Collapse: "collapse"
								}
							},
							divider: {
								type: "checkbox",
								text: "Show dividers"
							}
						}
					},
					_columns: {
						label: "Columns",
						divider: !0,
						type: "group",
						fields: {
							grid_default: {
								label: "Phone Portrait",
								description: "Set the number of grid columns for each breakpoint. <i>Inherit</i> refers to the number of columns on the next smaller screen size.",
								type: "select",
								options: {
									"1 Column": "1",
									"2 Columns": "2",
									"3 Columns": "3",
									"4 Columns": "4",
									"5 Columns": "5",
									"6 Columns": "6"
								}
							},
							grid_small: {
								label: "Phone Landscape",
								description: "Set the number of grid columns for each breakpoint. <i>Inherit</i> refers to the number of columns on the next smaller screen size.",
								type: "select",
								default: "",
								options: {
									Inherit: "",
									"1 Column": "1",
									"2 Columns": "2",
									"3 Columns": "3",
									"4 Columns": "4",
									"5 Columns": "5",
									"6 Columns": "6"
								}
							},
							grid_medium: {
								label: "Tablet Landscape",
								description: "Set the number of grid columns for each breakpoint. <i>Inherit</i> refers to the number of columns on the next smaller screen size.",
								type: "select",
								options: {
									Inherit: "",
									"1 Column": "1",
									"2 Columns": "2",
									"3 Columns": "3",
									"4 Columns": "4",
									"5 Columns": "5",
									"6 Columns": "6"
								}
							},
							grid_large: {
								label: "Desktop",
								description: "Set the number of grid columns for each breakpoint. <i>Inherit</i> refers to the number of columns on the next smaller screen size.",
								type: "select",
								default: "",
								options: {
									Inherit: "",
									"1 Column": "1",
									"2 Columns": "2",
									"3 Columns": "3",
									"4 Columns": "4",
									"5 Columns": "5",
									"6 Columns": "6"
								}
							},
							grid_xlarge: {
								label: "Large Screens",
								description: "Set the number of grid columns for each breakpoint. <i>Inherit</i> refers to the number of columns on the next smaller screen size.",
								type: "select",
								default: "",
								options: {
									Inherit: "",
									"1 Column": "1",
									"2 Columns": "2",
									"3 Columns": "3",
									"4 Columns": "4",
									"5 Columns": "5",
									"6 Columns": "6"
								}
							}
						}
					},
					_filter: {
						label: "Filter",
						divider: !0,
						type: "group",
						fields: {
							filter: {
								label: "Filter",
								type: "checkbox",
								text: "Enable filter navigation"
							},
							filter_source: {
								label: "Source",
								description: "Select the filter source.",
								type: "select",
								options: $taxonomies,
								enable: function (e) {
									return e.filter
								}
							},
							filter_style: {
								label: "Style",
								description: "Select the filter navigation style. The pill and divider styles are only available for horizontal Subnavs.",
								type: "select",
								options: {
									Tabs: "tab",
									"Subnav (Nav)": "subnav",
									"Subnav Divider (Nav)": "subnav-divider",
									"Subnav Pill (Nav)": "subnav-pill"
								},
								enable: function (e) {
									return e.filter
								}
							},
							filter_all: {
								label: "All Items",
								type: "checkbox",
								text: "Show filter control for all items",
								enable: function (e) {
									return e.filter
								}
							},
							filter_all_label: {
								attrs: {
									placeholder: "All"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_all;
									return t && i
								}
							},
							filter_position: {
								label: "Position",
								description: "Position the filter navigation at the top, left or right. A larger style can be applied to left and right navigations.",
								type: "select",
								options: {
									Top: "top",
									Left: "left",
									Right: "right"
								},
								enable: function (e) {
									return e.filter
								}
							},
							filter_style_primary: {
								type: "checkbox",
								text: "Primary navigation",
								enable: function (e, t) {
									var i = e.filter,
										l = e.filter_style,
										o = e.filter_position,
										n = t.$match;
									return i && ("left" == o || "right" == o) && n(l, "(^subnav)")
								}
							},
							filter_align: {
								label: "Alignment",
								description: "Align the filter controls.",
								type: "select",
								options: {
									Left: "left",
									Right: "right",
									Center: "center",
									Justify: "justify"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_position;
									return t && "top" == i
								}
							},
							filter_margin: {
								label: "Margin",
								description: "Set the vertical margin.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Default: "",
									Medium: "medium",
									Large: "large",
									"X-Large": "xlarge"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_position;
									return t && "top" == i
								}
							},
							filter_grid_width: {
								label: "Grid Width",
								description: "Define the width of the filter navigation. Choose between percent and fixed widths or expand columns to the width of their content.",
								type: "select",
								options: {
									Auto: "auto",
									"50%": "1-2",
									"33%": "1-3",
									"25%": "1-4",
									"20%": "1-5",
									Small: "small",
									Medium: "medium",
									Large: "large"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_position;
									return t && ("left" == i || "right" == i)
								}
							},
							filter_gutter: {
								label: "Grid Gutter",
								description: "Select the gutter width between the filter navigation and grid.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Medium: "medium",
									Default: "",
									Large: "large",
									Collapse: "collapse"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_position;
									return t && ("left" == i || "right" == i)
								}
							},
							filter_breakpoint: {
								label: "Grid Breakpoint",
								description: "Set the breakpoint from which the filter navigation and grid will stack.",
								type: "select",
								options: {
									"Small (Phone Landscape)": "s",
									"Medium (Tablet Landscape)": "m",
									"Large (Desktop)": "l"
								},
								enable: function (e) {
									var t = e.filter,
										i = e.filter_position;
									return t && ("left" == i || "right" == i)
								}
							}
						}
					},
					_lightbox: {
						label: "Lightbox",
						divider: !0,
						type: "group",
						fields: {
							lightbox: {
								label: "Lightbox",
								type: "checkbox",
								text: "Enable lightbox gallery"
							},
							_lightbox_image_dimension: {
								label: "Image Width/Height",
								description: "Setting just one value preserves the original proportions. The image will be resized and cropped automatically, and where possible, high resolution images will be auto-generated.",
								type: "grid",
								style: "group",
								fields: {
									lightbox_image_width: {
										width: "1-2",
										attrs: {
											placeholder: "auto",
											lazy: !0
										},
										enable: function (e) {
											return e.lightbox
										}
									},
									lightbox_image_height: {
										width: "1-2",
										attrs: {
											placeholder: "auto",
											lazy: !0
										},
										enable: function (e) {
											return e.lightbox
										}
									}
								}
							},
							lightbox_image_orientation: {
								label: "Image Orientation",
								description: "Width and height will be flipped accordingly, if the image is in portrait or landscape format.",
								type: "checkbox",
								text: "Allow mixed image orientations",
								enable: function (e) {
									return e.lightbox
								}
							},
							title_display: {
								label: "Show Title",
								description: "Display the title inside the panel, as the lightbox caption or both.",
								type: "select",
								default: "",
								options: {
									"Overlay + Lightbox": "",
									"Overlay only": "item",
									"Lightbox only": "lightbox"
								},
								enable: function (e) {
									var t = e.show_title,
										i = e.lightbox;
									return t && i
								}
							},
							content_display: {
								label: "Show Content",
								description: "Display the content inside the panel, as the lightbox caption or both.",
								type: "select",
								default: "",
								options: {
									"Overlay + Lightbox": "",
									"Overlay only": "item",
									"Lightbox only": "lightbox"
								},
								enable: function (e) {
									var t = e.show_content,
										i = e.lightbox;
									return t && i
								}
							}
						}
					},
					_panel: {
						label: "Panel",
						divider: !0,
						type: "group",
						fields: {
							panel_style: {
								label: "Style",
								description: "Select one of the boxed card styles or a blank panel.",
								type: "select",
								default: "",
								options: {
									None: "",
									"Card Default": "card-default",
									"Card Primary": "card-primary",
									"Card Secondary": "card-secondary",
									"Card Hover": "card-hover"
								}
							},
							panel_size: {
								label: "Size",
								description: "Define the card's size by selecting the padding between the card and its content.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Default: "",
									Large: "large"
								},
								enable: function (e) {
									return e.panel_style
								}
							}
						}
					},
					_title: {
						label: "Title",
						divider: !0,
						type: "group",
						fields: {
							title_style: {
								label: "Style",
								description: "Title styles differ in font-size but may also come with a predefined color, size and font.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Hero: "heading-hero",
									Primary: "heading-primary",
									H1: "h1",
									H2: "h2",
									H3: "h3",
									H4: "h4",
									H5: "h5",
									H6: "h6"
								},
								enable: function (e) {
									var t = e.show_title,
										i = e.title_display,
										l = e.lightbox;
									return t && ("lightbox" != i && l || !l)
								}
							},
							title_decoration: {
								label: "Decoration",
								description: "Decorate the title with a divider, bullet or a line that is vertically centered to the heading.",
								type: "select",
								default: "",
								options: {
									None: "",
									Divider: "divider",
									Bullet: "bullet",
									Line: "line"
								},
								enable: function (e) {
									var t = e.show_title,
										i = e.title_display,
										l = e.lightbox;
									return t && ("lightbox" != i && l || !l)
								}
							},
							title_color: {
								label: "Color",
								description: "Select the text color. If the Background option is selected, styles that don't apply a background image use the primary color instead.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Muted: "muted",
									Primary: "primary",
									Success: "success",
									Warning: "warning",
									Danger: "danger",
									Background: "background"
								},
								enable: function (e) {
									var t = e.show_title,
										i = e.title_display,
										l = e.lightbox;
									return t && ("lightbox" != i && l || !l)
								}
							},
							title_element: {
								label: "HTML Element",
								description: "Choose one of the six heading elements to fit your semantic structure.",
								type: "select",
								options: {
									H1: "h1",
									H2: "h2",
									H3: "h3",
									H4: "h4",
									H5: "h5",
									H6: "h6"
								},
								enable: function (e) {
									var t = e.show_title,
										i = e.title_display,
										l = e.lightbox;
									return t && ("lightbox" != i && l || !l)
								}
							}
						}
					},
					_meta: {
						label: "Meta",
						divider: !0,
						type: "group",
						fields: {
							meta_style: {
								label: "Style",
								description: "Select a predefined meta text style, including color, size and font-family.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Meta: "meta",
									Muted: "muted",
									H4: "h4",
									H5: "h5",
									H6: "h6"
								},
								enable: function (e) {
									return e.show_meta
								}
							},
							meta_align: {
								label: "Alignment",
								description: "Align the meta text above or below the title.",
								type: "select",
								options: {
									Top: "top",
									Bottom: "bottom"
								},
								enable: function (e) {
									return e.show_meta
								}
							},
							meta_margin: {
								label: "Margin",
								description: "Set the margin between title and meta text.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Small: "small",
									None: "remove"
								},
								enable: function (e) {
									return e.show_meta
								}
							}
						}
					},
					_content: {
						label: "Content",
						divider: !0,
						type: "group",
						fields: {
							content_style: {
								label: "Style",
								description: "Select a predefined text style, including color, size and font-family.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Lead: "lead"
								},
								enable: function (e) {
									var t = e.show_content,
										i = e.content_display,
										l = e.lightbox;
									return t && ("lightbox" != i && l || !l)
								}
							}
						}
					},
					_image: {
						label: "Image",
						divider: !0,
						type: "group",
						fields: {
							_image_dimension: {
								label: "Width/Height",
								description: "Setting just one value preserves the original proportions. The image will be resized and cropped automatically, and where possible, high resolution images will be auto-generated.",
								type: "grid",
								style: "group",
								fields: {
									image_width: {
										width: "1-2",
										attrs: {
											placeholder: "auto",
											lazy: !0
										},
										enable: function (e) {
											return e.show_image
										}
									},
									image_height: {
										width: "1-2",
										attrs: {
											placeholder: "auto",
											lazy: !0
										},
										enable: function (e) {
											return e.show_image
										}
									}
								}
							},
							image_card: {
								label: "Padding",
								description: "Top, left or right aligned images can be attached to the card's edge. If the image is aligned to the left or right, it will also extend to cover the whole space.",
								type: "checkbox",
								text: "Align image without padding",
								enable: function (e) {
									var t = e.show_image,
										i = e.panel_style,
										l = e.image_align;
									return t && i && "between" != l
								}
							},
							image_border: {
								label: "Border",
								description: "Select the image's border style.",
								type: "select",
								default: "",
								options: {
									None: "",
									Circle: "circle",
									Rounded: "rounded"
								},
								enable: function (e) {
									return e.show_image
								}
							},
							image_box_shadow: {
								label: "Box Shadow",
								description: "Select the image's box shadow size.",
								type: "select",
								default: "",
								options: {
									None: "",
									Small: "small",
									Medium: "medium",
									Large: "large",
									"X-Large": "xlarge"
								},
								enable: function (e) {
									var t = e.show_image,
										i = e.panel_style;
									return t && !i
								}
							},
							image_box_shadow_bottom: {
								type: "checkbox",
								text: "Add extra bottom shadow",
								enable: function (e) {
									var t = e.show_image,
										i = e.panel_style;
									return t && !i
								}
							},
							image_hover_box_shadow: {
								label: "Hover Box Shadow",
								description: "Select the image's box shadow size on hover.",
								type: "select",
								default: "",
								options: {
									None: "",
									Small: "small",
									Medium: "medium",
									Large: "large",
									"X-Large": "xlarge"
								},
								enable: function (e) {
									var t = e.show_link,
										i = e.show_image,
										l = e.panel_style,
										o = e.link_style;
									return t && i && !l && "panel" == o
								}
							},
							icon_ratio: {
								label: "Icon Size",
								description: "Enter a size ratio, if you want the icon to appear larger than the default font size, for example 1.5 or 2 to double the size.",
								attrs: {
									placeholder: "1"
								},
								enable: function (e) {
									return e.show_image
								}
							},
							icon_color: {
								label: "Icon Color",
								description: "Set the icon color.",
								type: "select",
								default: "",
								options: {
									Default: "",
									Muted: "muted",
									Primary: "primary",
									Success: "success",
									Warning: "warning",
									Danger: "danger"
								},
								enable: function (e) {
									return e.show_image
								}
							},
							image_align: {
								label: "Alignment",
								description: "Align the image to the top, left, right or place it between the title and the content.",
								type: "select",
								options: {
									Top: "top",
									Bottom: "bottom",
									Left: "left",
									Right: "right",
									Between: "between"
								},
								enable: function (e) {
									return e.show_image
								}
							},
							image_grid_width: {
								label: "Grid Width",
								description: "Define the width of the image within the grid. Choose between percent and fixed widths or expand columns to the width of their content.",
								type: "select",
								options: {
									Auto: "auto",
									"50%": "1-2",
									"33%": "1-3",
									"25%": "1-4",
									"20%": "1-5",
									Small: "small",
									Medium: "medium",
									Large: "large",
									"X-Large": "xlarge",
									"XX-Large": "xxlarge"
								},
								enable: function (e) {
									var t = e.show_image,
										i = e.image_align;
									return t && ("left" == i || "right" == i)
								}
							},
							image_gutter: {
								label: "Grid Gutter",
								description: "Select the gutter width between the image and content items.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Medium: "medium",
									Default: "",
									Large: "large",
									Collapse: "collapse"
								},
								enable: function (e) {
									var t = e.show_image,
										i = e.image_align,
										l = e.image_card,
										o = e.panel_style;
									return t && ("left" == i || "right" == i) && !(l && o)
								}
							},
							image_breakpoint: {
								label: "Grid Breakpoint",
								description: "Set the breakpoint from which grid cells will stack.",
								type: "select",
								options: {
									Always: "",
									"Small (Phone Landscape)": "s",
									"Medium (Tablet Landscape)": "m",
									"Large (Desktop)": "l"
								},
								enable: function (e) {
									var t = e.show_image,
										i = e.image_align;
									return t && ("left" == i || "right" == i)
								}
							},
							image_vertical_align: {
								label: "Vertical Alignment",
								description: "Vertically center grid cells.",
								type: "checkbox",
								text: "Center",
								enable: function (e) {
									var t = e.show_image,
										i = e.image_align;
									return t && ("left" == i || "right" == i)
								}
							}
						}
					},
					_link: {
						label: "Link",
						divider: !0,
						type: "group",
						fields: {
							link_text: {
								label: "Text",
								description: "Enter the text for the link.",
								enable: function (e) {
									return e.show_link
								}
							},
							link_target: {
								type: "checkbox",
								text: "Open in a new window",
								enable: function (e) {
									var t = e.show_link,
										i = e.lightbox;
									return t && !i
								}
							},
							link_style: {
								label: "Style",
								description: "Set the link style.",
								type: "select",
								options: {
									Link: "",
									"Link Muted": "link-muted",
									"Link Text": "link-text",
									"Button Default": "default",
									"Button Primary": "primary",
									"Button Secondary": "secondary",
									"Button Danger": "danger",
									"Button Text": "text",
									"Image/Card": "panel"
								},
								enable: function (e) {
									return e.show_link
								}
							},
							link_size: {
								label: "Button Size",
								description: "Set the button size.",
								type: "select",
								default: "",
								options: {
									Small: "small",
									Default: "",
									Large: "large"
								},
								enable: function (e) {
									var t = e.show_link,
										i = e.link_style;
									return t && i && "link-muted" != i && "link-text" != i && "panel" != i
								}
							}
						}
					},
					_general: {
						label: "General",
						type: "group",
						fields: {
							text_align: params.element.text_align_justify,
							text_align_breakpoint: params.element.text_align_breakpoint,
							text_align_fallback: params.element.text_align_justify_fallback,
							item_maxwidth: params.element.maxwidth,
							margin: params.element.margin,
							margin_remove_top: params.element.margin_remove_top,
							margin_remove_bottom: params.element.margin_remove_bottom,
							item_animation: params.element.animation,
							_parallax_button: params.element._parallax_button,
							visibility: params.element.visibility
						}
					}
				}
			}, {
				title: "Advanced",
				fields: {
					name: params.element.name,
					id: params.element.id,
					class: params.element.cls,
					css: {
						label: "CSS",
						description: "Enter your own custom CSS. The following selectors will be prefixed automatically for this element: <code>.el-element</code>, <code>.el-item</code>, <code>.el-title</code>, <code>.el-meta</code>, <code>.el-content</code>, <code>.el-image</code>, <code>.el-link</code>",
						type: "editor",
						editor: "code",
						mode: "css",
						attrs: {
							debounce: 500
						}
					}
				}
			}]

		}
	},

	// Set default values for fields
	data: function () {
		return {
			props: {
				query: '{"post_type":"post"}',
				show_title: !0,
				show_meta: !0,
				show_content: !0,
				show_image: !0,
				show_link: !0,
				grid_default: "1",
				grid_medium: "3",
				filter_source: "category",
				filter_style: "tab",
				filter_all: !0,
				filter_position: "top",
				filter_align: "left",
				filter_grid_width: "auto",
				filter_breakpoint: "m",
				title_element: "h3",
				meta_style: "meta",
				meta_align: "bottom",
				icon_ratio: 4,
				image_align: "top",
				image_grid_width: "1-2",
				image_breakpoint: "m",
				link_text: "Read more",
				link_style: "default",
				margin: "default"
			}
		};
	}

};