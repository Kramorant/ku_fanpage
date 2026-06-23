import { Component, OnInit } from '@angular/core';
import { NgFor, NgIf } from '@angular/common';
import { RouterLink } from '@angular/router';
import { BlogService } from '../../../core/services/blog.service';

@Component({
  selector: 'app-blog-list',
  standalone: true,
  imports: [NgFor, NgIf, RouterLink],
  templateUrl: './blog-list.component.html',
  styleUrl: './blog-list.component.css',
})
export class BlogListComponent implements OnInit {
  posts: any[] = [];

  constructor(private readonly blogService: BlogService) {}

  ngOnInit(): void {
    this.blogService.getAll().subscribe((data: any) => {
      this.posts = data?.data ?? [];
    });
  }
}
