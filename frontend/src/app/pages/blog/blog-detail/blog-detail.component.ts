import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { BlogService } from '../../../core/services/blog.service';

@Component({
  selector: 'app-blog-detail',
  standalone: true,
  templateUrl: './blog-detail.component.html',
  styleUrl: './blog-detail.component.css',
})
export class BlogDetailComponent implements OnInit {
  post: any;

  constructor(private readonly route: ActivatedRoute, private readonly blogService: BlogService) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (!id) {
      return;
    }

    this.blogService.getOne(id).subscribe((data: any) => {
      this.post = data?.data ?? data;
    });
  }
}
